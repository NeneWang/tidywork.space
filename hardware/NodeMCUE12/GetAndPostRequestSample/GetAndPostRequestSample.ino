#include <ArduinoJson.h>

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "FiOS-OMJJ7";
const char* password = "1010101010";
//Now you know my wifi password e.e

int workingColumn = 2;
int newCards = 0;;

HTTPClient http;  

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

    

    http.begin("http://wngnelson.com/api/tidywork/api/card.php");
    int httpCode = http.GET();

    if (httpCode > 0) { //Check the returning code

      String payload = http.getString();   //Get the request response payload
      DynamicJsonDocument doc(8192);
      deserializeJson(doc, payload);
      JsonArray arrayOfCards = doc["cards"].as<JsonArray>();
      for (JsonVariant v : arrayOfCards) {
        Serial.println(v.as<String>());
      }

      //      getFirstCardIndex(doc);


    }

    http.end();   //Close connection

  }

  delay(3000);    //Get Cards every so often
}

int getFirstCardIndex(DynamicJsonDocument doc) {
  int minIndex = 99;
  JsonArray arrayOfCards = doc["cards"].as<JsonArray>();
  for (JsonVariant v : arrayOfCards) {
    int index = (v["cardData"]["columnId"].as<int>());
    if (index < minIndex) {
      minIndex - index;
    }
  }

  return minIndex;

}

void confirmUpdate() {
  //If this is on, then add the newCards count;
  if (true) {
    newCards++;
  }
}


void updateUserData() {

  http.begin("http://wngnelson.com/api/tidywork/api/user.php?newCard=" + newCards);
  int httpCode = http.GET();

  //That should update the new card amounts
  newCards = 0;
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
