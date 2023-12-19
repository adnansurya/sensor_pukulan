#include "konfig.h" //file berisi settingan pengaturan wifi dan IP address server

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#include <NewPing.h>

#define TRIGGER_PIN D8    // Arduino pin tied to trigger pin on the ultrasonic sensor.
#define ECHO_PIN D7       // Arduino pin tied to echo pin on the ultrasonic sensor.
#define MAX_DISTANCE 200  // Maximum distance we want to ping for (in centimeters). Maximum sensor distance is rated at 400-500cm.

#define fsrAnalogPin A0  // FSR is connected to analog 0
#define buttonPin D5
#define ledPin D4
#define indikatorPin D2

int fsrReading;  // the analog reading from the FSR resistor divider
float lastTegangan;
float tegangan = 0.0;

int jarak = 0;

unsigned long timeStart = 0;
unsigned long timeStop = 0;


bool startTinju = false;
bool adaTinju = false;
int batasVoltTinju = 200;

unsigned long durasiTinju = 0;
int jarakTinju = 0;
float jarakTinjuMeter = 0.0;
float kecepatan = 0.0;
double beratTinju = 0.0;
double lastBerat = 0.0;


NewPing sonar(TRIGGER_PIN, ECHO_PIN, MAX_DISTANCE);  // NewPing setup of pins and maximum distance.

void setup() {

  Serial.begin(9600);

  Serial.println();
  pinMode(ledPin, OUTPUT);
  pinMode(indikatorPin, OUTPUT);
  digitalWrite(ledPin, HIGH);
  digitalWrite(indikatorPin, LOW);
  pinMode(buttonPin, INPUT_PULLUP);

  WiFi.begin(STASSID, STAPSK);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected! IP address: ");
  Serial.println(WiFi.localIP());

  digitalWrite(ledPin, LOW);
  digitalWrite(indikatorPin, HIGH);
  delay(500);
  digitalWrite(ledPin, HIGH);
  digitalWrite(indikatorPin, LOW);
  delay(500);
  digitalWrite(ledPin, LOW);
  digitalWrite(indikatorPin, HIGH);
  delay(500);
  digitalWrite(ledPin, HIGH);
  digitalWrite(indikatorPin, LOW);
  delay(500);
}

void loop() {


  fsrReading = analogRead(fsrAnalogPin);
  tegangan = float(fsrReading) / 1024.0 * 3.3 * 1000.0;  //miliVolt
  beratTinju = voltToWeight(double(tegangan));

  Serial.print("Voltage reading = ");
  Serial.print(tegangan);
  Serial.println(" mV");
  Serial.print("Berat = ");
  Serial.println(beratTinju);

  jarak = sonar.ping_cm();
  Serial.print("Jarak: ");
  Serial.print(jarak);  // Send ping, get distance in cm and print result (0 = outside set distance range)
  Serial.println(" cm");

  if (digitalRead(buttonPin) == 0 && startTinju == false) {
    digitalWrite(ledPin, LOW);
    digitalWrite(ledPin, LOW);
    digitalWrite(indikatorPin, HIGH);
    delay(200);
    digitalWrite(ledPin, HIGH);
    digitalWrite(indikatorPin, LOW);
    timeStart = millis();
    startTinju = true;
    jarakTinju = jarak;
    Serial.println("START TINJU");
  }

  if (startTinju) {
    if (lastTegangan <= batasVoltTinju && tegangan >= batasVoltTinju) {
      adaTinju = true;
      Serial.println("ADA TINJU");
    }
  }

  if (adaTinju) {
    if (beratTinju < lastBerat) {
      timeStop = millis();
      beratTinju = lastBerat;

      durasiTinju = (timeStop - timeStart);                         //detik
      jarakTinjuMeter = float(jarakTinju) / 100.0;                  //meter
      kecepatan = jarakTinjuMeter / (float(durasiTinju) / 1000.0);  // m/s
      kecepatan = kecepatan * 3.6;                                  // km / h

      Serial.println(durasiTinju);
      Serial.println(jarakTinjuMeter);
      Serial.println("STOP TINJU");
      adaTinju = false;
      startTinju = false;

      String postData = "";
      postData = "jarak=" + String(jarakTinju) + "&kecepatan=" + String(kecepatan) + "&berat=" + beratTinju;
      Serial.println(postData);
      sendDataToWeb(postData);
      digitalWrite(indikatorPin, HIGH);

      int delayBunyi = 500;
      if(beratTinju >= 5000){
        delayBunyi = beratTinju;
      }else if(beratTinju > 10000){
        delayBunyi = 10000;
      }
      delay(delayBunyi);
      timeStart = 0;
      timeStop = 0;
      durasiTinju = 0;
      
      digitalWrite(ledPin, HIGH);
      digitalWrite(indikatorPin, LOW);
    }
  }

  lastTegangan = tegangan;
  lastBerat = beratTinju;

  delay(10);
}



void sendDataToWeb(String datanya) {
  if (WiFi.status() == WL_CONNECTED) {

    WiFiClient client;
    HTTPClient http;

    Serial.print("[HTTP] begin...\n");
    // configure traged server and url
    http.begin(client, "http://" SERVER_IP "/sensor_pukulan/forms/add_pukulan.php");  // HTTP
    // http.addHeader("Content-Type", "application/json");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");


    Serial.print("[HTTP] POST...\n");
    // start connection and send HTTP header and body
    // int httpCode = http.POST("{\"hello\":\"world\"}");
    int httpCode = http.POST(datanya);

    // httpCode will be negative on error
    if (httpCode > 0) {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTP] POST... code: %d\n", httpCode);

      // file found at server
      if (httpCode == HTTP_CODE_OK) {
        const String& payload = http.getString();
        Serial.println("received payload:\n<<");
        Serial.println(payload);
        Serial.println(">>");
      }
    } else {
      Serial.printf("[HTTP] POST... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }

    http.end();
  }
  // wait for WiFi connection
  delay(1000);
}

double voltToWeight(double volt) {
  double weight = -(5.56555462 * pow(10, -14) * pow(volt, 6)) + (2.85746899 * pow(10, -10) * pow(volt, 5)) - (5.84529754 * pow(10, -7) * pow(volt, 4)) + (6.08854544 * pow(10, -4) * pow(volt, 3)) - (3.33093653 * pow(10, -1) * pow(volt, 2)) + (9.09651650 * pow(10, 1) * pow(volt, 1)) - (8.74010798 * pow(10, 3));
  return weight;
}

