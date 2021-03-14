#include <ArduinoJson.h>

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "FiOS-OMJJ7";
const char* password = "1010101010";
//Now you know my wifi password e.e

int workingColumn = 2;
int newCards = 0;

int countTrueCard = 0;
int countTrueTime = 0;
int countRep = 0;

#define SUC  D5
#define SUT  D7

boolean flagUpdateCard = false, prevflagUpdateCard = flagUpdateCard, flagUpdateTime = false, prevflagUpdateTime = flagUpdateTime;

HTTPClient http;

void setup () {

  Serial.begin(115200);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {

    delay(1000);
    Serial.println("Connecting..");

  }

  pinMode(SUC, INPUT);
  pinMode(SUT, INPUT);



}

void loop() {

  flagUpdateCard = digitalRead(SUC);
  flagUpdateTime = digitalRead(SUT);
  countTrueCard += flagUpdateCard;
  Serial.print(flagUpdateTime);
  countTrueTime += flagUpdateTime;
  countRep++;
  confirmUpdate();

  delay(200);
}

void getCardsData() {
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
  if (countRep > 4) {
    //    updateUserCard();
    updateUserTime();



    countRep = 0;
    countTrueTime = 0;
    countTrueCard = 0;
  }




}





void updateUserCard() {
  flagUpdateCard = countTrueCard > 2 ? 1 : 0;
  Serial.println("Output countTrueCard:" + (String)countTrueCard);

  if (flagUpdateCard != prevflagUpdateCard) {
    Serial.println("Output flagUpdate Card:" + (String)flagUpdateCard);
    Serial.println("Output flagUpdate Prev Card:" + (String)prevflagUpdateCard);
    Serial.println("Output countTrueCard:" + (String)countTrueCard);
    if (flagUpdateCard) {
      Serial.println("ng weapons");

      http.begin("http://wngnelson.com/api/tidywork/api/user.php?newCard");
      int httpCode = http.GET();
      if (httpCode > 0) { //Check the returning code
        Serial.println(flagUpdateCard);

        String payload = http.getString();   //Get the request response payload
        DynamicJsonDocument doc(8192);
        deserializeJson(doc, payload);

        newCards = 0;

      }

    }
    prevflagUpdateCard = flagUpdateCard;
  }
}


void updateUserTime() {
  flagUpdateTime = countTrueTime > 2 ? 1 : 0;
  Serial.println("Output countTrueTime:" + (String)countTrueTime);

  if (flagUpdateTime != prevflagUpdateTime) {
    Serial.println("Output flagUpdate Time:" + (String)flagUpdateTime);
    Serial.println("Output flagUpdate Prev Time:" + (String)prevflagUpdateTime);
    Serial.println("Output countTrueTime:" + (String)countTrueTime);
    if (flagUpdateTime) {
      Serial.println("ng weapons");

      http.begin("http://wngnelson.com/api/tidywork/api/user.php?updateTime");
      int httpCode = http.GET();
      if (httpCode > 0) { //Check the returning code
        Serial.println(flagUpdateCard);

        String payload = http.getString();   //Get the request response payload
        DynamicJsonDocument doc(8192);
        deserializeJson(doc, payload);

        newCards = 0;

      }

    }
    prevflagUpdateTime = flagUpdateTime;
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
