import numpy as np
import matplotlib.pyplot as plt

# Data
berat = np.array([500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000])
output = np.array([228, 391, 616, 787, 890, 909, 978, 1041, 1112, 1139, 1194, 1222, 1268, 1305, 1329, 1355, 1385, 1420, 1456, 1564])


# Regresi polinomial orde-n
coefficients = np.polyfit(berat, output, 6)

print(coefficients)

# Koefisien polinomial
a = coefficients[0]
b = coefficients[1]
c = coefficients[2]
d = coefficients[3]
e = coefficients[4]
f = coefficients[5]
g = coefficients[6]

def kalibrasi_berat_ke_resistensi(berat):
    return a * berat**6 + b * berat**5 + c * berat **4 + d * berat **3 + e * berat **2 + f * berat + g

# Menampilkan hasil regresi polinomial
plt.scatter(berat, output, label='Data')
berat_line = np.linspace(min(berat), max(berat), 100)
plt.plot(berat_line, kalibrasi_berat_ke_resistensi(berat_line), color='red', label='Regresi Polinomial')
plt.xlabel('Berat (kg)')
plt.ylabel('Tegangan (volt)')
plt.legend()
plt.show()# Fungsi kalibrasi

# Menampilkan persamaan kalibrasi
print(f'Fungsi Kalibrasi: V = {a:.4f}B^6 + {b:.4f}B^5 + {c:.4f}B^4 + {d:.4f}B^3 + {e:.4f}B^2 + {f:.4f}B + {g:.4f}')
