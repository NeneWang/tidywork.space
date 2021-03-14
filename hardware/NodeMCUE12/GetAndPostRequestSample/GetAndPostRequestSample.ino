#include <ArduinoJson.h>

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "FiOS-OMJJ7";
const char* password = "1010101010";

int workingColumn = 2;

void setup () {

  Serial.begin(115200);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {

    delay(1000);
    Serial.println("Connecting..");

  }

}

void loop() {

  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status

    HTTPClient http;  //Declare an object of class HTTPClient

    http.begin("http://wngnelson.com/api/tidywork/api/card.php");  //Specify request destination
    int httpCode = http.GET();                                  //Send the request

    if (httpCode > 0) { //Check the returning code

      String payload = http.getString();   //Get the request response payload
      DynamicJsonDocument doc(8192);
      deserializeJson(doc, payload);
      JsonArray arrayOfCards = doc["cards"].as<JsonArray>();
      for (JsonVariant v : arrayOfCards) {
        Serial.println(v.as<String>());
      }

      getFirstCardIndex(doc);


    }

    http.end();   //Close connection

  }

  delay(3000);    //Send a request every 30 seconds
}

int getFirstCardIndex(DynamicJsonDocument doc) {

  JsonArray arrayOfCards = doc["cards"].as<JsonArray>();
  for (JsonVariant v : arrayOfCards) {
    Serial.println(v["cardData"]["columnId"].as<String>());
  }

}

void communicateDataToArduino(DynamicJsonDocument doc) {


  while (Serial.available()) {
    delay(1);
    if (Serial.available() > 0) {
      char c = doc["cards"][getFirstCardIndex(doc)];  //gets one byte from serial buffer
      if (isControl(c)) {
        //'Serial.println("it's a control character");
        Serial.println(c);
        break;
      }
    }
  }

}
