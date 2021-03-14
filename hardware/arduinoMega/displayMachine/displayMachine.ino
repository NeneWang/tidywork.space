#include <Elegoo_GFX.h>                   // Core graphics library
#include <Elegoo_TFTLCD.h>                // Hardware-specific library
#include <TouchScreen.h> //// Touch Support  
#include <TimerOne.h>


// macros for color (16 bit)
#define BLACK   0x0000
#define BLUE    0x001F
#define RED     0xF800
#define GREEN   0x07E0
#define CYAN    0x07FF
#define MAGENTA 0xF81F
#define YELLOW  0xFFE0
#define WHITE   0xFFFF

#define LIGHTGREY 0xE71C



//Tuch screen
#define TS_MINX 920
#define TS_MINY 120
#define TS_MAXX 150
#define TS_MAXY 940
#define YP A3
#define XM A2
#define YM 9
#define XP 8

TouchScreen ts = TouchScreen(XP, YP, XM, YM, 300);

#define LCD_CS A3
#define LCD_CD A2
#define LCD_WR A1
#define LCD_RD A0
#define LCD_RESET A4


Elegoo_TFTLCD tft(LCD_CS, LCD_CD, LCD_WR, LCD_RD, LCD_RESET);


//CONFIG
const int COUNTER_MAX = 25;
const int SCREEN_HEIGHT = 320;
const int SCREEN_WIDTH = 240;

//DEFINE MODS
#define MODE_PLAY 0
#define MODE_PAUSE 1

//##variables

long counterSegs = 0, timerSegs = 0, ms = 0;
String cardName = "sample card", columnName = "Doing", timerText = "";

//controllers
int counterStatus = MODE_PAUSE;
int timerStatus = MODE_PAUSE;





void setup() {

  counterStatus = MODE_PLAY;
  timerStatus = MODE_PLAY;
  Serial.begin(9600);
  //Timer One     
  Timer1.initialize (1000);
  Timer1.attachInterrupt(timerOne);

  //Setup touchScreen
  tft.reset();
  tft.begin(0x9341);
  refreshScreen();


}

void loop() {
  // put your main code here, to run repeatedly:

}


//general machine

void iterateEverySecond() {
  refreshDigits();

}


void refreshScreen() {
  pinModeWriter();
  paintAllBlack();
  
  
  paintButtons();
  refreshDigits();
  
  pinModeReader();

}

void refreshDigits() {
  pinModeWriter();
  paintDigitsBlack();
  
  printDigits();



  pinModeReader();

}


//screen

void pinModeWriter() {
  pinMode(XM, OUTPUT);
  pinMode(YP, OUTPUT);
}

void pinModeReader() {
}

//Paint function should be called after pinModeWriter()

void paintAllBlack() {

  tft.fillScreen(BLACK);
  tft.fillRect(0, 0, SCREEN_WIDTH, SCREEN_HEIGHT, BLACK);
}

void paintDigitsBlack() {

  tft.fillRect(SCREEN_WIDTH/2, 0, SCREEN_WIDTH, SCREEN_HEIGHT / 2, BLACK);
}

void printDigits() {
  printCard();
  printColumn();
  printTimer();
  printCounter();
}

void paintButtons() {

  //Painting

  tft.fillRect(0, SCREEN_HEIGHT * 3 / 4, SCREEN_WIDTH / 2, 80, LIGHTGREY);
  tft.fillRect( SCREEN_WIDTH * 1 / 2, SCREEN_HEIGHT * 3 / 4, SCREEN_WIDTH / 2, SCREEN_HEIGHT * 1 / 4, LIGHTGREY);

  tft.fillRect( 0, SCREEN_HEIGHT * 2 / 4, SCREEN_WIDTH / 2, 80, YELLOW);
  tft.fillRect( SCREEN_WIDTH * 1 / 2, SCREEN_HEIGHT * 2 / 4, SCREEN_WIDTH / 2, SCREEN_HEIGHT * 1 / 4, GREEN);



  //Borders
  tft.drawRect( 0, SCREEN_HEIGHT * 3 / 4, SCREEN_WIDTH / 2, 80, WHITE);
  tft.drawRect( SCREEN_WIDTH * 1 / 2, SCREEN_HEIGHT * 3 / 4, SCREEN_WIDTH / 2, SCREEN_HEIGHT * 1 / 4, WHITE);

  tft.drawRect( 0, SCREEN_HEIGHT * 2 / 4, SCREEN_WIDTH / 2, 80, WHITE);
  tft.drawRect( SCREEN_WIDTH * 1 / 4 , SCREEN_HEIGHT * 2 / 4, SCREEN_WIDTH / 4, 80, WHITE);
  tft.drawRect( SCREEN_WIDTH * 1 / 2, SCREEN_HEIGHT * 2 / 4, SCREEN_WIDTH / 2, SCREEN_HEIGHT * 1 / 4, WHITE);


  //Text
  locateAndPrint("Timer", SCREEN_WIDTH * 1 / 8, SCREEN_HEIGHT * 27 / 32, 2);
  locateAndPrint("Counter", SCREEN_WIDTH * 9 / 16, SCREEN_HEIGHT * 27 / 32, 2);


  locateAndPrint("Card", SCREEN_WIDTH * 1 / 16, SCREEN_HEIGHT * 20 / 32, 1);
  locateAndPrint("Board", SCREEN_WIDTH * 5 / 16, SCREEN_HEIGHT * 20 / 32, 1);

  locateAndPrint("Counter", SCREEN_WIDTH * 9 / 16, SCREEN_HEIGHT * 19 / 32, 2);



}


void printCard() {
  String message = "Card: ";
  locateAndPrint( message, SCREEN_WIDTH * 1 / 12, SCREEN_HEIGHT * 1 / 6, 2);
  locateAndPrint( cardName, SCREEN_WIDTH * 13 / 24, SCREEN_HEIGHT * 1 / 6, 1.2);

}

void printColumn() {
  String message = "Table: ";
  locateAndPrint( message, SCREEN_WIDTH * 1 / 12, SCREEN_HEIGHT * 2 / 9, 2);
  locateAndPrint( columnName, SCREEN_WIDTH * 13 / 24, SCREEN_HEIGHT * 2 / 9, 2);
}

void printTimer() {
  String message = "Timer: ";
  locateAndPrint( message, SCREEN_WIDTH * 1 / 12, SCREEN_HEIGHT * 5 / 18, 2);
  locateAndPrint( (String)timerSegs, SCREEN_WIDTH * 13 / 24, SCREEN_HEIGHT * 5 / 18, 2);
}


void printCounter() {
  String message = "Counter: ";
  locateAndPrint( message, SCREEN_WIDTH * 1 / 12, SCREEN_HEIGHT * 1 / 3, 2);
  locateAndPrint( (String)counterSegs, SCREEN_WIDTH * 13 / 24, SCREEN_HEIGHT * 1 / 3, 2);
}

void locateAndPrint(String text, double x, double y, double size) {
  tft.setTextSize(size);
  tft.setCursor(x, y);
  tft.println(text);

}




//button handlers


void timerOne(void) {

  ms = ms + 1;
  if (ms >= 1000) {
    iterateEverySecond();
    ms = 0;
    if (counterStatus == MODE_PLAY) {
      counterSegs = counterSegs + 1;
    }

    if (timerStatus == MODE_PLAY) {
      timerSegs = timerSegs + 1;
    }
  }
}
