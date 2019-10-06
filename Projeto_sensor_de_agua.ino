#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <WiFiClientSecure.h>
#include <WiFiServer.h>
#include <WiFiUdp.h>

#define sensor_1 16
#define sensor_2 5
#define sensor_3 4




#include "ESP8266WiFi.h"

const char* ssid     = "VIVO-1DB0";
const char* password = "5760501DB0";

const char* host = "192.168.15.7";
const char* streamId   = "....................";
const char* privateKey = "....................";
const int httpPort = 80;
 
int sensor1,sensor2,sensor3;
void setup() {

  pinMode(sensor_1,INPUT);
  pinMode(sensor_2,INPUT);
  pinMode(sensor_3,INPUT);
  
  Serial.begin(115200);
  delay(10);

  // We start by connecting to a WiFi network

  Serial.println();
  Serial.println();
  Serial.print("Conectando com ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi conectado");  
  Serial.println("Endereco de IP: ");
  Serial.println(WiFi.localIP());
}



void loop() {
 
sensor1 = digitalRead(sensor_1);
sensor2 = digitalRead(sensor_2);
sensor3 = digitalRead(sensor_3);

//sensor1 = 20;
//sensor2 =10;
//sensor3=30;
  Serial.print(sensor1);
  Serial.print(" || ");
  Serial.println(sensor2);
  Serial.print(" || ");
  Serial.println(sensor3);

  Serial.print("connecting to ");
  Serial.println(host);
  
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 80; // porta de conexao
  if (!client.connect(host, httpPort)) {
    Serial.println("Falha na conexao!");
    return;
  }
  
  // We now create a URI for the request
  String  url = "/nodemcu/salvar.php?";
          url += "sensor1=";
          url += sensor1;
          url += "&sensor2=";
          url += sensor2;
          url += "&sensor3=";
          url += sensor3;
  
  Serial.print("Requisitando URL: ");
  Serial.println(url);
  
  // This will send the request to the server
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }
  
  // Read all the lines of the reply from server and print them to Serial
  while(client.available()){
    String line = client.readStringUntil('\r');
    //Serial.print(line);
    
    Serial.println();
    if(line.indexOf("salvo_com_sucesso") !=-1){
      Serial.println("salvo com sucesso");
    }else if (line.indexOf ("erro_ao_salvar")!=-1){
        Serial.println("ocorreu um erro ");
        // ligar dispositivos em digitalWrite (alarme, HIGH);
    }
  }
  
  Serial.println();
  Serial.println("Conexao fechada");

    delay(10000);// tempo de nova solicitação 
  
}
