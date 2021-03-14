#include <Elegoo_GFX.h>                   // Core graphics library
#include <Elegoo_TFTLCD.h>                // Hardware-specific library
#include <TouchScreen.h> //// Touch Support  
#include <TimerOne.h>

//CONFIG
const int COUNTER_MAX = 25;
const int SCREEN_HEIGHT = 320;
const int SCREEN_WIDTH = 240;

//DEFINE MODS
#define MODE_PLAY 0
#define MODE_PAUSE 1



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

// macros for color (16 bit)
#define BLACK   0x0000
#define BLUE    0x001F
#define RED     0xF800
#define GREEN   0x07E0
#define CYAN    0x07FF
#define MAGENTA 0xF81F
#define YELLOW  0xFFE0
#define WHITE   0xFFFF

#define LCD_CS A3
#define LCD_CD A2
#define LCD_WR A1
#define LCD_RD A0
#define LCD_RESET A4


Elegoo_TFTLCD tft(LCD_CS, LCD_CD, LCD_WR, LCD_RD, LCD_RESET);


//##variables

long counterSegs = 0, timerSegs = 0, ms = 0;
String cardName = "sample card", tableName = "Doing", timerText = "";

//controllers
int counterStatus = MODE_PAUSE;
int timerStatus = MODE_PAUSE;




void setup() {
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

}


void refreshScreen() {
  pinModeWriter();

}

void refreshDigits() {
  pinModeWriter();

}


//screen

void pinModeWriter() {
  pinMode(XM, OUTPUT);
  pinMode(YP, OUTPUT);
}

void pinModeReader() {
  pinMode(XM, INPUT);
  pinMode(YP, INPUT);
}

void paintDigitsBlack() {
  pinModeWriter();
  

}

void paintButtons() {
  
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
