#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <WiFi.h>

#define DHTPIN 16 // Pin yang terhubung ke sensor DHT11
#define DHTTYPE DHT11 // Tipe sensor DHT
#define MQ2PIN 35 // Pin yang terhubung ke sensor MQ-2
int lcdColumns = 16;
int lcdRows = 2;
DHT dht(DHTPIN, DHTTYPE);

LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows); // Alamat I2C LCD 0x27, 16 kolom, 2 baris

const char *ssid = "wifi ana";     // Ganti dengan SSID WiFi Anda
const char *password = "wifi kencang ga bikin kembung"; // Ganti dengan password WiFi Anda
const char *serverAddress = "iotuasbjm.000webhostapp.com"; // Alamat web server

void setup() {
  Serial.begin(115200);
  lcd.init();
  lcd.backlight();
  dht.begin();

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  // Baca data dari sensor DHT11
  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();

  // Baca data dari sensor MQ-2
  int gasValue = analogRead(MQ2PIN);

  // Tampilkan data di Serial Monitor
  Serial.print("Temp: ");
  Serial.print(temperature);
  Serial.print(" °C, Humidity: ");
  Serial.print(humidity);
  Serial.print("%, Gas Value: ");
  Serial.println(gasValue);

  // Kirim data ke server PHP
  sendDataToServer(temperature, humidity, gasValue);

  // Tampilkan data suhu di LCD
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Temp: ");
  lcd.print(temperature);
  lcd.print(" C");
  lcd.setCursor(0, 1);
  lcd.print("Gas : ");
  lcd.print(gasValue);

  delay(2000); // Tunggu 2 detik sebelum membaca data lagi
}

void sendDataToServer(float temperature, float humidity, int gasValue) {
  // Buat objek klien Wi-Fi
  WiFiClient client;

  // Buat URL untuk mengirim data ke server PHP
  String url = "/koneksi1.php"; // Ganti dengan path yang sesuai di web Anda

  // Hubungkan ke server
  if (client.connect(serverAddress, 80)) {
    Serial.println("Connected to server");

    // Buat string data yang akan dikirim
    
      String line = client.readStringUntil('\r');
      Serial.print(line);
    

    // Tutup koneksi
    client.stop();
    Serial.println("Connection closed");
  } else {
    Serial.println("Failed to connect to server");
  }
}
