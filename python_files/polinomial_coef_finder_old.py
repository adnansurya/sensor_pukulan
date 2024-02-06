import numpy as np
import matplotlib.pyplot as plt

# Data
berat = np.array([25.7, 36.3, 66.3, 213.5, 584.7])
output = np.array([74.2, 190.3, 341.9, 448.4, 1132.3])

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
