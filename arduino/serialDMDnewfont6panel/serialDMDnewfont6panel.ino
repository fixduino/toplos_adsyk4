/*--------------------------------------------------------------------------------------
  Includes
--------------------------------------------------------------------------------------*/
#include <SPI.h>        //SPI.h must be included as DMD is written by SPI (the IDE complains otherwise)
#include <DMD.h>        //
#include <TimerOne.h>   //
#include "font4.h"
//#include "Arial_Black_16.h"
//Fire up the DMD library as dmd
#define DISPLAYS_ACROSS 3
#define DISPLAYS_DOWN 4
DMD dmd(DISPLAYS_ACROSS, DISPLAYS_DOWN);
int i = 0;
int c = 0;
int active = 0;
int index;
String buffertext = "";
String inputString = "";
String header = "";
char CT1[10];
char CT2[10];
char CT3[10];
char CT4[10];
char CT5[10];
char CT6[10];
char CT7[10];
char CT8[10];
char CT9[10];
char CT10[10];
char CT11[10];
char CT12[10];
char CT13[10];
char CT14[10];
char CT15[10];
char CT16[10];

boolean stringComplete = false;  // whether the string is complete
/*--------------------------------------------------------------------------------------
  Interrupt handler for Timer1 (TimerOne) driven DMD refresh scanning, this gets
  called at the period set in Timer1.initialize();
--------------------------------------------------------------------------------------*/
void ScanDMD()
{
  dmd.scanDisplayBySPI();
}

/*--------------------------------------------------------------------------------------
  setup
  Called by the Arduino architecture before the main loop begins
--------------------------------------------------------------------------------------*/
void setup(void)
{

  //initialize TimerOne's interrupt/CPU usage used to scan and refresh the display
  Timer1.initialize( 5000 );           //period in microseconds to call ScanDMD. Anything longer than 5000 (5ms) and you can see flicker.
  Timer1.attachInterrupt( ScanDMD );   //attach the Timer1 interrupt to ScanDMD which goes to dmd.scanDisplayBySPI()

  //clear/init the DMD pixels held in RAM
  dmd.clearScreen( true );   //true is normal (all pixels off), false is negative (all pixels on)
  Serial.begin(4800);
  inputString.reserve(200);
  buffertext.reserve(200);
}

/*--------------------------------------------------------------------------------------
  loop
  Arduino architecture main loop
--------------------------------------------------------------------------------------*/
void loop(void)
{
  if (stringComplete) {       //jika ada perintah
    buffertext = inputString;
    Serial.println(buffertext);
    header = buffertext.substring(0, 3);
    Serial.print("header: ");
    Serial.println(header);
    if (header == "01:")
    {
      //Serial.println("satu dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT1, 10);
    }
    else if (header == "02:")
    {
      //Serial.println("dua dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT2, 10);
    }
    else if (header == "03:")
    {
      //Serial.println("tiga dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT3, 10);
    }
    else if (header == "04:")
    {
      //Serial.println("empat dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT4, 10);
    }
    else if (header == "05:")
    {
      //Serial.println("lima dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT5, 10);
    }
    else if (header == "06:")
    {
      //Serial.println("enam dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT6, 10);
    }
    else if (header == "07:")
    {
      //Serial.println("tujuh dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT7, 10);
    }
    else if (header == "08:")
    {
      //Serial.println("delapan dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT8, 10);
    }
    else if (header == "09:")
    {
      //Serial.println("sembilan dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT9, 10);
    }
    else if (header == "10:")
    {
      //Serial.println("sepuluh dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT10, 10);
    }
    else if (header == "11:")
    {
      //Serial.println("sebelas dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT11, 10);
    }
    else if (header == "12:")
    {
      //Serial.println("duabelas dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT12, 10);
    }
    else if (header == "13:")
    {
      //Serial.println("tigabelas dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT13, 10);
    }
    else if (header == "14:")
    {
      //Serial.println("empatbelas dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT14, 10);
    }
    else if (header == "15:")
    {
      //Serial.println("limabelas dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT15, 10);
    }
    else if (header == "16:")
    {
      //Serial.println("enambelas dipilih");
      buffertext.substring(3, buffertext.length() - 1).toCharArray(CT16, 10);
    }
    else if (header == "17:")
    {
      //Serial.println("tujuhbelas dipilih");
      active = buffertext.substring(10, buffertext.length() - 1).toInt();
      //Serial.println(buffertext.substring(10, buffertext.length() - 1));
      //Serial.println(active);
    }
    inputString = "";    // clear the string:
    stringComplete = false;
  }

  dmd.selectFont(font4);        //pilih font kecil
  dmd.drawLine(  46, 0, 46, 64, GRAPHICS_NORMAL ); //gambar garis tengah
  dmd.drawChar( 0, 0, CT1[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 0, CT1[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 0, CT1[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 0, CT1[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 0, CT1[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 0, CT1[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 0, CT1[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 0, CT1[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 0, CT1[8], GRAPHICS_NORMAL );
  dmd.drawChar( 0, 8, CT2[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 8, CT2[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 8, CT2[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 8, CT2[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 8, CT2[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 8, CT2[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 8, CT2[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 8, CT2[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 8, CT2[8], GRAPHICS_NORMAL );

  dmd.drawChar( 0, 16, CT3[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 16, CT3[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 16, CT3[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 16, CT3[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 16, CT3[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 16, CT3[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 16, CT3[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 16, CT3[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 16, CT3[8], GRAPHICS_NORMAL );
  dmd.drawChar( 0, 24, CT4[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 24, CT4[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 24, CT4[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 24, CT4[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 24, CT4[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 24, CT4[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 24, CT4[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 24, CT4[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 24, CT4[8], GRAPHICS_NORMAL );

  dmd.drawChar( 0, 32, CT5[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 32, CT5[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 32, CT5[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 32, CT5[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 32, CT5[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 32, CT5[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 32, CT5[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 32, CT5[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 32, CT5[8], GRAPHICS_NORMAL );
  dmd.drawChar( 0, 40, CT6[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 40, CT6[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 40, CT6[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 40, CT6[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 40, CT6[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 40, CT6[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 40, CT6[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 40, CT6[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 40, CT6[8], GRAPHICS_NORMAL );

  dmd.drawChar( 0, 48, CT7[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 48, CT7[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 48, CT7[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 48, CT7[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 48, CT7[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 48, CT7[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 48, CT7[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 48, CT7[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 48, CT7[8], GRAPHICS_NORMAL );
  dmd.drawChar( 0, 56, CT8[0], GRAPHICS_NORMAL );
  dmd.drawChar( 5, 56, CT8[1], GRAPHICS_NORMAL );
  dmd.drawChar( 10, 56, CT8[2], GRAPHICS_NORMAL );
  dmd.drawChar( 13, 56, CT8[3], GRAPHICS_NORMAL );
  dmd.drawChar( 18, 56, CT8[4], GRAPHICS_NORMAL );
  dmd.drawChar( 23, 56, CT8[5], GRAPHICS_NORMAL );
  dmd.drawChar( 28, 56, CT8[6], GRAPHICS_NORMAL );
  dmd.drawChar( 33, 56, CT8[7], GRAPHICS_NORMAL );
  dmd.drawChar( 38, 56, CT8[8], GRAPHICS_NORMAL );

  // kolom 2
  dmd.drawChar( 50, 0, CT9[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 0, CT9[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 0, CT9[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 0, CT9[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 0, CT9[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 0, CT9[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 0, CT9[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 0, CT9[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 0, CT9[8], GRAPHICS_NORMAL );
  dmd.drawChar( 50, 8, CT10[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 8, CT10[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 8, CT10[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 8, CT10[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 8, CT10[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 8, CT10[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 8, CT10[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 8, CT10[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 8, CT10[8], GRAPHICS_NORMAL );

  dmd.drawChar( 50, 16, CT11[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 16, CT11[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 16, CT11[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 16, CT11[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 16, CT11[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 16, CT11[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 16, CT11[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 16, CT11[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 16, CT11[8], GRAPHICS_NORMAL );
  dmd.drawChar( 50, 24, CT12[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 24, CT12[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 24, CT12[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 24, CT12[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 24, CT12[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 24, CT12[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 24, CT12[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 24, CT12[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 24, CT12[8], GRAPHICS_NORMAL );

  dmd.drawChar( 50, 32, CT13[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 32, CT13[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 32, CT13[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 32, CT13[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 32, CT13[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 32, CT13[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 32, CT13[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 32, CT13[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 32, CT13[8], GRAPHICS_NORMAL );
  dmd.drawChar( 50, 40, CT14[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 40, CT14[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 40, CT14[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 40, CT14[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 40, CT14[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 40, CT14[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 40, CT14[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 40, CT14[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 40, CT14[8], GRAPHICS_NORMAL );

  dmd.drawChar( 50, 48, CT15[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 48, CT15[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 48, CT15[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 48, CT15[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 48, CT15[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 48, CT15[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 48, CT15[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 48, CT15[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 48, CT15[8], GRAPHICS_NORMAL );
  dmd.drawChar( 50, 56, CT16[0], GRAPHICS_NORMAL );
  dmd.drawChar( 55, 56, CT16[1], GRAPHICS_NORMAL );
  dmd.drawChar( 60, 56, CT16[2], GRAPHICS_NORMAL );
  dmd.drawChar( 65, 56, CT16[3], GRAPHICS_NORMAL );
  dmd.drawChar( 70, 56, CT16[4], GRAPHICS_NORMAL );
  dmd.drawChar( 75, 56, CT16[5], GRAPHICS_NORMAL );
  dmd.drawChar( 80, 56, CT16[6], GRAPHICS_NORMAL );
  dmd.drawChar( 85, 56, CT16[7], GRAPHICS_NORMAL );
  dmd.drawChar( 90, 56, CT16[8], GRAPHICS_NORMAL );

  c = c + 1;  // bikin hitungan kedip kedip tangki aktif
  if (c == 10) {
    c = 0;
    //dmd.clearScreen( true );
    dmd.drawFilledBox(0, ((active-1)*8), 9, ((active-1)*8)+7, GRAPHICS_INVERSE );
    delay(500);
  }
  delay(40);

}

void serialEvent() {
  while (Serial.available()) {
    // get the new byte:
    char inChar = (char)Serial.read();
    // add it to the inputString:
    inputString += inChar;
    // if the incoming character is a newline, set a flag so the main loop can
    // do something about it:
    if (inChar == '#') {
      stringComplete = true;
    }
  }
}


