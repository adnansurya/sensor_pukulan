#include <NewPing.h>
#include <SoftwareSerial.h>


#define TRIGGER_PIN 12    // Arduino pin tied to trigger pin on the ultrasonic sensor.
#define ECHO_PIN 11       // Arduino pin tied to echo pin on the ultrasonic sensor.
#define MAX_DISTANCE 200  // Maximum distance we want to ping for (in centimeters). Maximum sensor distance is rated at 400-500cm.

#define fsrAnalogPin A0  // FSR is connected to analog 0
#define buttonPin 7

int fsrReading;  // the analog reading from the FSR resistor divider
int lastReading;

int jarak = 0;

unsigned long timeStart = 0;
unsigned long timeStop = 0;


bool startTinju = false;
bool adaTinju = false;

unsigned long durasiTinju = 0;
int jarakTinju = 0;
float jarakTinjuMeter = 0.0;
float kecepatan = 0.0;
int beratTinju = 0;


NewPing sonar(TRIGGER_PIN, ECHO_PIN, MAX_DISTANCE);  // NewPing setup of pins and maximum distance.
SoftwareSerial mySerial(8, 9);                       // RX, TX


void setup(void) {
  Serial.begin(9600);  // We'll send debugging information via the Serial monitor
  while (!Serial) {
    ;  // wait for serial port to connect. Needed for native USB port only
  }

  mySerial.begin(9600);

  pinMode(buttonPin, INPUT_PULLUP);
}

void loop(void) {

  fsrReading = analogRead(fsrAnalogPin);
  // Serial.print("Analog reading = ");
  // Serial.println(fsrReading);

  jarak = sonar.ping_cm();
  // Serial.print("Jarak: ");
  // Serial.print(jarak);  // Send ping, get distance in cm and print result (0 = outside set distance range)
  // Serial.println(" cm");


  if (digitalRead(buttonPin) == 0 && startTinju == false) {
    timeStart = millis();
    startTinju = true;
    jarakTinju = jarak;
    Serial.println("START TINJU");
  }

  if (startTinju) {
    if (lastReading == 0 && fsrReading > 0) {
      adaTinju = true;
      Serial.println("ADA TINJU");
    }
  }

  if (adaTinju) {
    if (fsrReading < lastReading) {
      timeStop = millis();
      beratTinju = lastReading;
      durasiTinju = (timeStop - timeStart);  //detik
      jarakTinjuMeter = float(jarakTinju) / 100.0; //meter
      kecepatan = jarakTinjuMeter / (float(durasiTinju)/1000.0);  // m/s
      kecepatan = kecepatan * 3.6; // km / h

      Serial.println(durasiTinju);
      Serial.println(jarakTinjuMeter);
      Serial.println("STOP TINJU");
      adaTinju = false;
      startTinju = false;

      String postData = "";
      postData = "jarak=" + String(jarakTinju) + "&kecepatan=" + String(kecepatan) + "&berat=" + beratTinju;
      mySerial.println(postData);
      Serial.println(postData);
      timeStart = 0;
      timeStop = 0;
      durasiTinju = 0;
      delay(10000);
    }
  }

  lastReading = fsrReading;

  delay(10);
}