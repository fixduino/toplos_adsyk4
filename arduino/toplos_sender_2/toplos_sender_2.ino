/*
ads:
-request tiap 30 menit data baru jika tidak dipake menu=0
-topping tangki max 3 didisplay
- set tangki aktif topping dengan set deret tangki
- set pampable kok negatif.OK
- max refuler_nom max 15, qty max 25000

*/

#include <SPI.h>
#include <Ethernet.h>
byte mac[] = {  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
// change to your network settings
IPAddress ip(192, 168, 0, 105);
IPAddress gateway(192, 168, 0, 1);
IPAddress subnet(255, 255, 255, 0);
// change to your server
IPAddress server(192, 168, 0, 100); //101pcku 100serverptm
char serverName[] = "localhost";
int serverPort = 80; //8080 80
EthernetClient client;

char pageAdd[256]; //128 256
char inChar;
String dataIn;
int countRetry = 0;
int reqData = 0;
int cancel = 0; int setOK = 0;
int qtyPam = 0;


void(* resetFunc) (void) = 0;

#include <LiquidCrystal_I2C.h>
#include <Wire.h>
#include <Keypad.h>
#include <Password.h>

int set = 0;
int menu = 0;
int submenu = 0;
int menuExit = 0;
boolean parsing = false;

int i = 0;
int b = 0;
int sensor1 = A0;
int sensor2 = A1;
int sensor3 = A2;
int sensor4 = A3;
int pausa = 10;
int x = 0;
int y = 0;
int z = 0;
char tecla;
int sensorValue = 0;
//LiquidCrystal lcd (13,12,11,10,9,8);

int ledState = LOW;
int nomRef = 0;
int nomTank = 0;
int qtyTop = 0;
String deretTopping;
String deretLossing;
 String haloQty;
unsigned long prev2Millis = 0;

unsigned long prev3Millis = 0;
int interval = 200;
unsigned long previousMillis = 0;

//button ditekan HOLD                     // (LOW is pressed b/c i'm using the pullup resistors)
long millis_held;    // How long the button was held (milliseconds)
long secs_held;      // How long the button was held (seconds)
long prev_secs_held; // How long the button was held in the previous check
byte previous = HIGH;
unsigned long firstTime; // how long since the button was first pressed
String token = "PTMADS";

/* parsing*/
String P1, P2, P3, P4, P5, P6, P7, P8, Top, Top2, Los, Los2, His1, His2, His3, His4, ActTop;
int ActTopOk;


 //param loading or sending data
      char refBuf[5];
      char qtyBuf[8];
      char actBuf[8];
       //param deret tank topping
      char tokenBuf[8];
      char deretBuf[17]; //1-2-3-4-5-6-7-8
      char deretLosBuf[17]; //1-2-3-4-5-6-7-8
      //param set pampable
      char tankBuf[10];
      char paBuf[10];

       char deretBufX[17]; //1-2-3-4-5-6-7-8
      char deretLosBufX[17]; //1-2-3-4-5-6-7-8

//configuracion teclado matricial

const byte ROWS = 4;
const byte COLS = 4;
char hexaKeys[ROWS][COLS] = {
  {'1', '2', '3', 'A'},
  {'4', '5', '6', 'B'},
  {'7', '8', '9', 'C'},
  {'*', '0', '#', 'D'}
};

/*
A: Option
B: Set
C: Clear
D: Enter
*/
//byte rowPins [ROWS] = {4,5,6,7}; //Asignacion pines filas
//byte colPins [COLS] = {0,1,2,3};   //Asignacion pines columnas
byte rowPins[ROWS] = {A0, A1, A2, A3}; //A-B-C-D connect to the row pinouts of the keypad
byte colPins[COLS] = {9, 8, 7, 6}; //1-2-3-4 connect to the column pinouts of the keypad
//no.urut 12345678 === pin 54329876
Keypad customKeypad = Keypad( makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS); // variable_mapa de la matriz


//LiquidCrystal lcd(8, 9, 10, 11, 12, 13);
LiquidCrystal_I2C lcd(0x27, 2, 16);//3F 27
int count = 0;
String setRef, setQty;
long first = 0;
long second = 0;
double total = 0;
String deretKedua;
int cekricek = 0;



uint8_t degree[8]  = // make a cute degree symbol
{140, 146, 146, 140, 128, 128, 128, 128};
byte termometru[8] = //icon for termometer
{
  B00100,
  B01010,
  B01010,
  B01110,
  B01110,
  B11111,
  B11111,
  B01110
};
byte arrow_u[8] = {
  B00100,
  B01110,
  B10101,
  B00100,
  B00100,
  B00100,
  B00100,
  B00100
};
byte arrow_d[8] = {
  B00100,
  B00100,
  B00100,
  B00100,
  B00100,
  B11111,
  B01110,
  B00100
};
byte arrow_leftku[8] = {
  B00011,
  B00110,
  B01100,
  B11111,
  B11111,
  B01100,
  B00110,
  B00011
};

byte buntut_arrowku[8] = {
  0x18,
  0x0C,
  0x06,
  0x1F,
  0x1F,
  0x06,
  0x0C,
  0x18
};
byte alarm[8] = {
  B00000,
  B00100,
  B01110,
  B01110,
  B01110,
  B11111,
  B00100,
  B00000
};


byte p1[8] = {
  B10000,
  B10000,
  B10000,
  B10000,
  B10000,
  B10000,
  B10000,
  B10000

};

byte p2[8] = {
  B11000,
  B11000,
  B11000,
  B11000,
  B11000,
  B11000,
  B11000,
  B11000

};

byte p3[8] = {
  B11100,
  B11100,
  B11100,
  B11100,
  B11100,
  B11100,
  B11100,
  B11100
};

byte p4[8] = {
  B11110,
  B11110,
  B11110,
  B11110,
  B11110,
  B11110,
  B11110,
  B11110
};

byte p5[8] = {
  B11111,
  B11111,
  B11111,
  B11111,
  B11111,
  B11111,
  B11111,
  B11111
};
byte arrow_r[] = {
  B11000,
  B01100,
  B00110,
  B00011,
  B00011,
  B00110,
  B01100,
  B11000
};


void loadanim() {
  lcd.setCursor(0, 0);
  lcd.print("     LOADING");
  lcd.setCursor(0, 1);
  for (int loadbar = 0; loadbar < 20; loadbar++) {
    lcd.setCursor(loadbar, 1);
    lcd.write(6);
    lcd.setCursor(loadbar, 2);
    lcd.write(6);
    lcd.setCursor(loadbar, 3);
    lcd.write(6);
    delay(10);
    lcd.setCursor(loadbar, 1);
    lcd.write(7);
    lcd.setCursor(loadbar, 2);
    lcd.write(7);
    lcd.setCursor(loadbar, 3);
    lcd.write(7);
    delay(10);
    lcd.setCursor(loadbar, 1);
    lcd.write(8);
    lcd.setCursor(loadbar, 2);
    lcd.write(8);
    lcd.setCursor(loadbar, 3);
    lcd.write(8);
    delay(10);
    lcd.setCursor(loadbar, 1);
    lcd.write(9);
    lcd.setCursor(loadbar, 2);
    lcd.write(9);
    lcd.setCursor(loadbar, 3);
    lcd.write(9);
    delay(10);
    lcd.setCursor(loadbar, 1);
    lcd.write(10);
    lcd.setCursor(loadbar, 2);
    lcd.write(10);
    lcd.setCursor(loadbar, 3);
    lcd.write(10);
    delay(10);
  }
  delay(500);
  lcd.clear();
}


void setup() {
  Serial.begin(4800);
  Serial1.begin(4800);
  lcd.begin(); //20x4

  // Start ethernet
  Serial.println(F("Starting ethernet..."));
  Ethernet.begin(mac, ip, gateway, gateway, subnet);

  // If using dhcp, comment out the line above
  // and uncomment the next 2 lines
  // if(!Ethernet.begin(mac)) Serial.println(F("failed"));
  //  else Serial.println(F("ok"));

  digitalWrite(10, HIGH);
  Serial.println(Ethernet.localIP());
  delay(5000);
  Serial.println(F("Ready"));

  lcd.createChar(0, arrow_leftku);
  lcd.createChar(1, buntut_arrowku);
  lcd.createChar(2, arrow_u);
  lcd.createChar(3, arrow_d);
  lcd.createChar(4, alarm);
  lcd.createChar(5, arrow_r);// arrow >
  lcd.createChar(6, p1);
  lcd.createChar(7, p2);
  lcd.createChar(8, p3);
  lcd.createChar(9, p4);
  lcd.createChar(10, p5);
  Serial.print("Inisialisasi......");

  // ------- Quick 3 blinks of backlight  -------------
  //  for(int i = 0; i< 3; i++)
  //  {
  //    lcd.backlight();
  //    delay(250);
  //    lcd.noBacklight();
  //    delay(250);
  //  }
  //  lcd.backlight(); // finish with backlight on

  //  loadanim(); //loadanim ganggu icon suhu?

  //-------- Write characters on the display ------------------
  lcd.setCursor(0, 0); //Start at character 4 on line 0
  lcd.print("  TOPPING-LOSSING   ");
  delay(1000);
  lcd.setCursor(0, 1);
  lcd.print("PERTAMINA ADISUCIPTO"); // Print text on 2nd Line
  delay(1000);
  dataIn = "";
  reqData = 1;
  reqDataWeb(); //load data awal
  lcd.clear();

}

void loop() {
  cekricek++;
  Serial.println(cekricek);

  if (parsing) {
    parsingData();
    parsing = false;
    dataIn = "";
  }

  unsigned long currentMillis = millis();
  // dibaca cuma 1 detik sekali
  if (currentMillis - prev2Millis > 2000) {
    prev2Millis = currentMillis;
    if (menu == 0) {       // menu utama
      Serial.println(".");
    }
  }

  //cek data ulang setiap 30 menit = 1800000,, 15 mnt = 900000
  if (currentMillis - prev3Millis > 900000) {
    prev3Millis = currentMillis;
    if ((menu == 0)) {     // menu utama && cekricek > 60
      Serial.println("-cek data ulang..");
      reqData = 1;
      reqDataWeb();
      lcd.clear();

    }
  }


  //set waktu blink
  if (currentMillis - previousMillis > 1000) {
    previousMillis = currentMillis;
    if (ledState == LOW) {
      ledState = HIGH;
    }
    else {
      ledState = LOW;
    }
  }

  z = 0;
  y = 0;
  tecla = customKeypad.getKey();
  //  MSNinicio();
  // delay(300);//500
  if (tecla) // Check for a valid key.
  {
    switch (tecla)
    {

      case 'A': // tombol opsi
        lcd.clear();
        if (submenu == 0) {
          menu = menu + 1;
          if (menu > 3) {
            menu = 0;
          }
        } else if (submenu > 0) {
          submenu = submenu + 1;
          if (submenu > 3) {
            submenu = 1;
          }
        } else if (submenu > 4) {
          submenu = submenu + 1;
          if (submenu > 7) {
            submenu = 5;
          }
        }
        break;

      case 'B': // tombol Set...
        lcd.clear();
        if (menu == 0) {
          lcd.setCursor (0, 0);
          lcd.print("TOPPING dipilih");
          Serial.println("pilih topping gan..");
          menu = 4;
        }
        else if (menu == 1) {
          lcd.clear();
          lcd.setCursor (0, 0);
          lcd.print("LOSSING N/A      ");
          Serial.println("pilih lossing gan..");
          delay(2000);
          menu = 0;
        }
        else if (menu == 2) {
          lcd.clear();
          lcd.setCursor (0, 0);
          lcd.print("SETUP dipilih        ");
          Serial.println("pilih Setup gan..");
          // delay(2000);
          menu = 5;
          submenu = 1;
        }
        else if (menu == 3) {
          lcd.clear();
          lcd.setCursor (0, 0);
          lcd.print("LOG N/A          ");
          Serial.println("pilih LOG gan..");
          delay(2000);
          menu = 0;
        } else if (menu == 4) {
          lcd.clear();
          lcd.setCursor (0, 0);
          lcd.print("LOG N/A          ");
          Serial.println("pilih LOG gan..");
          delay(2000);
          menu = 0; //submenu =5 6 7
        } else if (menu == 5) {
          lcd.clear();
          if (submenu == 1) {
            lcd.setCursor (0, 0);
            lcd.print("Setup Tangki TOP-LOS      ");
            Serial.println("setup Topping..");
            delay(2000);
            lcd.clear();
            menu = 8; //masuk void topping
          } else if (submenu == 2) {
            lcd.setCursor (0, 0);
            lcd.print("Refresh Data        ");
            Serial.println("setup Other..");
            dataIn = "";
            reqData = 1;
            reqDataWeb();
            delay(1000); lcd.clear();
            goHome();
            //menu = 9; //masuk void lossing
          } if (submenu == 3) {
            lcd.setCursor (0, 0);
            lcd.print("Adjust Pa Tangki         ");
            Serial.println("setup Pumpable..");
            delay(2000); lcd.clear();
            menu = 10; //masuk void Pumpable
          }

        } else if (menu == 6) {
          lcd.clear();
          lcd.setCursor (0, 0);
          lcd.print("LOSSING dipilih       ");
          Serial.println("setup Lossing..");
          delay(2000);
          menu = 0; goHome();
        } else if (menu == 7) {
          lcd.clear();
          lcd.setCursor (0, 0);
          lcd.print("LOG dipilih          ");
          Serial.println("pilih LOG gan..");
          delay(2000);
          menu = 0; goHome();
        }
        //        else if (menu == 8) {
        //          //lcd.clear();
        //          lcd.setCursor (0, 3);
        //          lcd.print("Enter untuk dikirim         ");
        //          Serial.println("pilih LOG gan..");
        //          delay(2000);
        //          menu = 0; goHome();
        //        }
        break;
      case 'C': // tambah +
        //lcd.clear();
        if (menu == 5) { //proses topping
          Serial.println("tambah gan..");
          goHome();
        }
        break;

      case '#': // tambah +
        //lcd.clear();
        if (set == 0) { //proses topping
          Serial.println("tambah gan..");
        }
        break;

      case '*': // kurangi -
        //lcd.clear();
        if (set == 0) {
          Serial.println("kurangi gan..");
        }
        break;


    }
  }



  if (menu == 0) {
    lcd.setCursor(0, 0);
    lcd.write(5);
    lcd.print(" TOPPING     ");
    lcd.setCursor(0, 1);
    lcd.print("  LOSSING    ");
    lcd.setCursor(0, 2);
    lcd.print("  SETUP      ");
    lcd.setCursor(0, 3);
    lcd.print("  LOG        ");
  }
  if (menu == 1) {
    lcd.setCursor(0, 0);
    lcd.print("  TOPPING    ");
    lcd.setCursor(0, 1);
    lcd.write(5);
    lcd.print(" LOSSING     ");
    lcd.setCursor(0, 2);
    lcd.print("  SETUP      ");
    lcd.setCursor(0, 3);
    lcd.print("  LOG        ");
  }
  if (menu == 2) {
    lcd.setCursor(0, 0);
    lcd.print("  TOPPING    ");
    lcd.setCursor(0, 1);
    lcd.print("  LOSSING    ");
    lcd.setCursor(0, 2);
    lcd.write(5);
    lcd.print(" SETUP       ");
    lcd.setCursor(0, 3);
    lcd.print("  LOG        ");
  }
  if (menu == 3) {
    lcd.setCursor(0, 0);
    lcd.print("  TOPPING    ");
    lcd.setCursor(0, 1);
    lcd.print("  LOSSING   ");
    lcd.setCursor(0, 2);
    lcd.print("  SETUP     ");
    lcd.setCursor(0, 3);
    lcd.write(5);
    lcd.print(" LOG        ");
    lcd.setCursor(10, 3);
  }

  if ((menu == 4)) {
    //lcd.clear();
    //    if (ledState == HIGH) {
    lcd.setCursor(0, 0);
    lcd.print("TOPPING");
    lcd.setCursor(0, 1);
    lcd.print("Refu:");
    lcd.print(" " + String(nomRef));
    lcd.setCursor(0, 2);
    lcd.print("Qty :");
    lcd.print(" " + String(qtyTop));
    topping2();
  }



  if ((menu == 5) && (submenu == 1)) {
    lcd.setCursor(0, 0);
    lcd.write(5);
    lcd.print(" Set Tangki TOP-LOS");
    lcd.setCursor(0, 1);
    lcd.print("Reload Data");
    lcd.setCursor(0, 2);
    lcd.print("Set Pumpable   ");
  }
  if ((menu == 5) && (submenu == 2)) {
    lcd.setCursor(0, 0);
    lcd.print("Set Tangki TOP-LOS");
    lcd.setCursor(0, 1);
    lcd.write(5);
    lcd.print(" Reload Data");
    lcd.setCursor(0, 2);
    lcd.print("Set Pumpable    ");
  }
  if ((menu == 5) && (submenu == 3)) {
    lcd.setCursor(0, 0);
    lcd.print("Set Tangki TOP-LOS");
    lcd.setCursor(0, 1);
    lcd.print(" Reload Data");
    lcd.setCursor(0, 2);
    lcd.write(5);
    lcd.print(" Set Pumpable   ");
  }

  if ((menu == 8)) {
    lcd.setCursor(0, 0);
    adjTankTop();
  }
  if ((menu == 9)) {
    lcd.setCursor(0, 0);
    lcd.print("Not Available");
    lcd.setCursor(0, 1);
    //    lcd.print("Tangki:");
    //    lcd.setCursor(7, 1);
    //    lcd.print("N/A");
    if (ledState == HIGH) {
      lcd.print("Set: N/A");
    } else if (ledState == LOW) {
      lcd.print("            ");
    }
    delay(1000);
    goHome();
    //adjTankPa();
  }
  if ((menu == 10)) {
    lcd.setCursor(0, 0);
    lcd.print("Pumpable tangki");
    lcd.setCursor(0, 1);
    lcd.print("Tangki:");
    lcd.setCursor(7, 1);
    lcd.print(nomTank);
    adjTankPa();
  }
}

void adjTankPa() {
  while (menu == 10)
  {
    tecla = customKeypad.getKey(); // CHOOSE ZONE
    delay(100);
    switch (tecla)
    {
      case '0' ... '9': // This keeps collecting the first value until a operator is pressed "+-*/"
        lcd.setCursor(7, 1);
        first = first * 10 + (tecla - '0');
        lcd.print(first);
//        if ((first >0) &&(first < 9)) {
//          first = first * 10 + (tecla - '0');
//          lcd.setCursor(7, 1);
//          lcd.print(first);
//          lcd.setCursor(0, 3);
//          lcd.print("                  ");
//        } else {
//          lcd.setCursor(0, 3);
//          lcd.print("Max Tank 8!");
//          first=0;
//           lcd.setCursor(7, 1); 
//          lcd.print(first+" ");
//        }
        
        break;
      case 'B': // set ref OK, then pindah ke qty
        //    lcd.clear();
        if ((first <= 8) &&(first>0)) {
        nomTank = first;
        Serial.print("nomTank");
        Serial.print(nomTank);
        lcd.setCursor(7, 1);
        lcd.print(nomTank);
        lcd.setCursor(18, 1);
        lcd.print("OK");
        lcd.setCursor(0, 2);
        lcd.print("Pumpab:");
        lcd.setCursor(0, 3);
          lcd.print("                   ");
        second = SecondNumber2();
        first = 0; second = 0;
        menu = 0;
        }else if (first==0) {
          lcd.setCursor(0, 3);
          lcd.print("Tangki Not Null!");
          first=0;
          lcd.setCursor(7, 1); 
          lcd.print(first+"");
        }else {
          lcd.setCursor(0, 3);
          lcd.print("Max Tangki 8!     ");
          first=0;
          lcd.setCursor(7, 1); 
          lcd.print(first+"");
        }
        break;

      case 'C':
        lcd.setCursor(7, 1);
        cancel = cancel + 1;
        lcd.print("0          ");
        first = 0;
        lcd.setCursor(0, 3);
        lcd.print("                   ");
        if (cancel > 3)
        {
          goHome();
        }
        break;

//      case 'D':
//        lcd.setCursor(0, 0);
//        Serial.println("sending data..");
//        reqData = 4; //send new pumpable
//        sendDataToWeb();
//        count++;
//        Serial.println(count);
//        goHome();
//        Serial.println("menu = "); Serial.print(menu);
//        break;
    }
  }
}

long SecondNumber2()
{
//  second=0;
  while ( 1 )
  {
    tecla = customKeypad.getKey();
    if (tecla >= '0' && tecla <= '9')
    {
      second = second * 10 + (tecla - '0');
      lcd.setCursor(7, 2);
      lcd.print(second);
      Serial.println(second);
      Serial.println(qtyPam);
//      second = 0;
    }
    if (tecla == 'C')
    {
      second = 0; qtyPam = 0;
      lcd.setCursor(7, 2);
      lcd.print(second + "       ");
      lcd.setCursor(0, 3);
      lcd.print("                   ");
      cancel = cancel + 1;
      
      Serial.println(second);
      Serial.println(qtyPam);
    }
    if ((tecla == 'C') && (cancel > 3))
    {
      //      second = 0;
      
      goHome();
      break;
    }
    if (tecla == 'B')
    {
      qtyPam=second;
      Serial.print("second = ");
      Serial.println(second); //qtyPam= second;
      
      Serial.println("qtyPam");
      Serial.println(qtyPam);
      if (second == 0) {
        haloQty = "00";
      }else if (second > 0)
      {
        haloQty = String(second);
      }
       Serial.print("haloQty"); Serial.println(haloQty);
       
      lcd.setCursor(18, 2);
      lcd.print("OK");
      lcd.setCursor(0, 3);
      lcd.print("Enter untuk Kirim");
    }
    if (tecla == 'D') {
      lcd.setCursor(0, 0);
      Serial.println("sending data..");
      reqData = 4;
      sendDataToWeb();
      count++;
      Serial.println(count);
      goHome();
      Serial.println("menu = "); Serial.print(menu);
      break;
    }
  }
  return second;
}



void adjTankTop() {
  lcd.setCursor(0, 0);
  lcd.print("Set TOPP LOSS");
  lcd.setCursor(0, 1);
  lcd.print("Topp:");
  while (menu == 8)
  {
    tecla = customKeypad.getKey(); // CHOOSE ZONE
    delay(100);
    switch (tecla)
    {
      case '0' ... '9': // This keeps collecting the first value until a operator is pressed "+-*/"
        lcd.setCursor(0, 1);
        lcd.print("Topp:");
        lcd.setCursor(5, 1);
        first = first * 10 + (tecla - '0');
        if (deretTopping.length() < 5) {
          deretTopping = deretTopping + String(first) + "-";
          lcd.print(deretTopping);
        } else {
          lcd.setCursor(0, 3);
          lcd.print("Max 3 Tangki!");
        }

        first = 0;
       
        break;
      case 'B': // set deret
//       Serial.print("haloQty"); Serial.println(haloQty);
        lcd.setCursor(0, 1);
        lcd.print("Topp:");
        Serial.print("Deret");
        Serial.print(deretTopping);
         if ((deretTopping == "0-")||(deretTopping == "0-0-")||(deretTopping == "0-0-0-")) {
          deretTopping = "00-";Serial.print("sini");
        }
        lcd.setCursor(1, 2);
        lcd.print(deretTopping);
        lcd.setCursor(18, 1);
        lcd.print("OK");
        lcd.setCursor(0, 3);
        lcd.print("                   ");
        lcd.setCursor(0, 2);
        deretKedua = "";
        deretLossing = deretLoss();
        first = 0; deretKedua = "";
        menu = 0;
        break;

      case 'C':
        //    lcd.clear();
        lcd.setCursor(5, 1);
        cancel = cancel + 1;
        lcd.print("0          ");
        first = 0;  deretTopping = ""; deretLossing = ""; 
        lcd.setCursor(0, 2);
        lcd.print("                   ");        
        lcd.setCursor(0, 3);
        lcd.print("                   ");
        if (cancel > 3)
        {
          goHome();
        }
        break;


    }
  }
}

String deretLoss()
{
  lcd.setCursor(0, 2);
  lcd.print("Loss:          ");

  while ( 1 )
  {
    tecla = customKeypad.getKey();
    if (tecla >= '0' && tecla <= '9')
    {
      lcd.setCursor(5, 2);
      second = second * 10 + (tecla - '0');
      if (deretKedua.length() < 5) {
        deretKedua = deretKedua + String(second) + "-";
        lcd.print(deretKedua);Serial.print(deretKedua);Serial.println(deretKedua);
      } else {
        lcd.setCursor(0, 3);
        lcd.print("Max 3 Tangki!");
      }
      second = 0;
    }
    if (tecla == 'C')
    {
      deretKedua = "";
      lcd.setCursor(5, 2);
      lcd.print(deretKedua + "         ");
      cancel = cancel + 1;
      lcd.setCursor(0, 3);
      lcd.print("                   ");
    }
    if ((tecla == 'C') && (cancel > 3))
    {
      //      second = 0;
      goHome();
      break;
    }
    if (tecla == 'B')
    {
        if ((deretKedua == "0-")||(deretKedua == "0-0-")||(deretKedua == "0-0-0-")) {
          deretLossing = "00-";Serial.print("sini");
        }else 
        {
          deretLossing = deretKedua; Serial.print("sono");
        }
      
      Serial.print(deretLossing);
      lcd.setCursor(18, 2);
      lcd.print("OK");
      lcd.setCursor(0, 3);
      lcd.print("Enter untuk Kirim");
    }
    if (tecla == 'D') {
      lcd.setCursor(0, 0);
      //      lcd.print("TOPPING DIKIRIM     ");
      //param nomRef dan qtyTop, send to server
      //      lcd.setCursor(0, 3);
      //      sendingAnim();
      Serial.println("sending data..");
      reqData = 3;
      sendDataToWeb();
      count++;
      Serial.println(count);
      goHome();
      Serial.println("menu = "); Serial.print(menu);
      break;
    }

  }
  return deretKedua;
}


void topping2() {
  while (menu == 4)
  {
    tecla = customKeypad.getKey(); // CHOOSE ZONE
    delay(100);
    switch (tecla)
    {
      case '0' ... '9': // This keeps collecting the first value until a operator is pressed "+-*/"
        if (first < 16) {
          first = first * 10 + (tecla - '0');
          lcd.setCursor(6, 1);
          lcd.print(first);
          lcd.setCursor(0, 3);
          lcd.print("                  ");
        } else {
          lcd.setCursor(0, 3);
          lcd.print("Max Refuler 16!");
          first=0;
           lcd.setCursor(6, 1); 
          lcd.print(first+" ");
        }
        break;
      case 'B': // set ref OK, then pindah ke qty
        //    lcd.clear();
        if ((first <= 16) &&(first>0)) {
          nomRef = first;
        Serial.print("nomRef");
        Serial.print(nomRef);
        lcd.setCursor(6, 1);
        lcd.print(nomRef);
        lcd.setCursor(18, 1);
        lcd.print("OK ");
//        lcd.setCursor(0, 3);
//        lcd.print("                   ");
        second = SecondNumber();
        first = 0; second = 0;
        menu = 0;
        }else if (first==0) {
          lcd.setCursor(0, 3);
          lcd.print("Refuler Not Null!");
          first=0;
          lcd.setCursor(6, 1); 
          lcd.print(first+"");
        }else {
          lcd.setCursor(0, 3);
          lcd.print("Max Refuler 16!");
          first=0;
          lcd.setCursor(6, 1); 
          lcd.print(first+"");
        }
        break;

      case 'C':
        lcd.setCursor(6, 1);
        cancel = cancel + 1;
        first = 0; 
        lcd.print(first+"        ");  
        if (cancel > 3)
        {
          goHome();
        }
        break;

//      case 'D':
//        lcd.setCursor(0, 0);
//        Serial.println("sending data..");
//        reqData = 2;
//        sendDataToWeb();
//        count++;
//        Serial.println(count);
//        goHome();
//        Serial.println("menu = "); Serial.print(menu);
//        break;
    }
  }
}

long SecondNumber()
{
  while ( 1 )
  {
    tecla = customKeypad.getKey();
    if (tecla >= '0' && tecla <= '9')
    {
          second = second * 10 + (tecla - '0');
          lcd.setCursor(6, 2);
          lcd.print(second);
    }
    if (tecla == 'C')
    {
      second = 0;
      lcd.setCursor(6, 2);
      lcd.print(second + " ");
      cancel = cancel + 1;
//        lcd.setCursor(0, 3);
//          lcd.print("                   ");
        
    }
    if ((tecla == 'C') && (cancel > 3))
    {
      //      second = 0;
      goHome();
      break;
    }
    if (tecla == 'B')
    {
       if ((second >0) && (second <= 45000)) {
      qtyTop = second;
      Serial.print(qtyTop);
      lcd.setCursor(18, 2);
      lcd.print("OK");
      lcd.setCursor(0, 3);
      lcd.print("Enter untuk Kirim");
        } else if (second ==0) {
        lcd.setCursor(0, 3);
          lcd.print("Liter Not Null!");
          second=0;
          lcd.setCursor(6, 2); 
          lcd.print("0             ");
        } else if(second > 45000){
//          lcd.setCursor(6, 2); 
//          lcd.print("          ");
          lcd.setCursor(0, 3);
          lcd.print("Max Liter 45000!");
          second=0;
          lcd.setCursor(6, 2); 
          lcd.print("0             ");
        }    
    }
    if (tecla == 'D') {
      if ((nomRef==0) ||(nomRef>16)){
        Serial.print("cancelation!");
        lcd.setCursor(0, 3);
        lcd.print("Not Null!      ");
        delay(1000);
        goHome();
        
      }else if ((nomRef==0) &&(qtyTop==0)){
        Serial.print("cancelation!");
        lcd.setCursor(0, 3);
        lcd.print("Not Null!      ");
        delay(1000);
        goHome();
      }else if ((nomRef>0) &&(qtyTop==0)){
        Serial.print("cancelation!");
        lcd.setCursor(0, 3);
        lcd.print("Liter Not Null!");
        delay(1000);
        goHome();
      }else{
        lcd.setCursor(0, 0);
      //      lcd.print("TOPPING DIKIRIM     ");
      //param nomRef dan qtyTop, send to server
      //      lcd.setCursor(0, 3);
      //      sendingAnim();
      Serial.println("sending data..");
      reqData = 2;
      sendDataToWeb();
      count++;
      Serial.println(count);
      goHome();
      Serial.println("menu = "); Serial.print(menu);
        }
      
      break;
    }
    
  }
  return second;
}



byte getPage(IPAddress ipBuf, int thisPort, char *page)
{
  //  int inChar;
  char outBuf[256]; //256

  Serial.print(F("connecting..."));

  lcd.clear();

  if (reqData == 1) {
    for (int i = 0; i <= 50; i++) {
      lcd.setCursor(0, 0);
      lcd.print("Loading Data :");
      lcd.print(i);
      lcd.print("%");
      lcd_percentage(i, 0, 10, 3);
      delay(10);
    }
  } else if ((reqData == 2) || (reqData == 3) || (reqData == 4)) {
    for (int i = 0; i <= 50; i++) {
      lcd.setCursor(0, 0);
      lcd.print("Sending Data :");
      lcd.print(i);
      lcd.print("%");
      lcd_percentage(i, 0, 10, 3);
      delay(10);
    }
  }

  if (client.connect(ipBuf, thisPort))
  {
    Serial.println(F("connected"));
    sprintf(outBuf, "GET %s HTTP/1.1", page);
    client.println(outBuf);
    sprintf(outBuf, "Host: %s", serverName);
    client.println(outBuf);
    client.println(F("Connection: close\r\n"));
  }
  else
  {
    Serial.println(F("failed"));
    return 0;
  }

  // connectLoop controls the hardware fail timeout
  int connectLoop = 0;

  while (client.connected())
  {
    while (client.available())
    {

      //ori
      inChar = client.read();
      dataIn += inChar;
      Serial.write(inChar);
      if (inChar == '\n') { // parsing \n #
        parsing = true;
      }
      // set connectLoop to zero if a packet arrives
      connectLoop = 0;


    }

    connectLoop++;


    // if more than 10000 milliseconds since the last packet
    if (connectLoop > 10000)
    {
      // then close the connection from this end.
      Serial.println();
      Serial.println(F("Timeout"));
      client.stop();
    }

    // this is a delay for the connectLoop timing
    delay(1);


  }

  Serial.println();

  Serial.println(F("disconnecting."));
  // close client end
  client.stop();

  return 1;
}


void reqDataWeb() {
    Serial.print("Retry request: ");
    Serial.println(countRetry);
  sprintf(pageAdd, "/adisucipto/cekalldatarev.php");
  Serial.println(pageAdd);
  lcd.clear();
  if (!getPage(server, serverPort, pageAdd))
  {
    for (int i = 0; i <= 10; i++) {
      lcd.setCursor(0, 0);
      lcd.print("Loading Data :");
      lcd.print(i);
      lcd.print("%");
      lcd_percentage(i, 0, 20, 3);
      delay(10);
    }
    Serial.print(F("Fail "));
    countRetry++;
    
    if (countRetry == 5) {
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Loading data Failed!");
      lcd.setCursor(0, 1);
      lcd.print("Retry Again");
      countRetry = 0;
      delay(1000);
      goHome();
    }else{
         reqDataWeb();
    }
 
  }
  else {

    if (reqData == 1) {
      for (int i = 50; i <= 100; i++) {
        lcd.setCursor(0, 0);
        lcd.print("Loading Data :");
        lcd.print(i);
        lcd.print("%");
        lcd_percentage(i, 0, 20, 3);
        delay(10);
      }
    } else if (reqData == 2) {
      for (int i = 50; i <= 100; i++) {
        lcd.setCursor(0, 0);
        lcd.print("Sending Data :");
        lcd.print(i);
        lcd.print("%");
        lcd_percentage(i, 0, 20, 3);
        delay(10);
      }
    }
    Serial.print(F("Pass "));
    countRetry = 0;
  }
  //        delay(1000);
  delay(2000);
}

void sendDataToWeb() {
  Serial.print("Retry request: ");
    Serial.println(countRetry);
  
  if (countRetry == 0) { //siapkan parameter pas awalan dapet data
      itoa(nomRef, refBuf, 10);
      itoa(qtyTop, qtyBuf, 10);
      itoa(ActTopOk, actBuf, 10);
    
      //param deret tank topping
      token.toCharArray(tokenBuf, 8);
      Serial.println(token);
      int pjgDeret = deretTopping.length();
      deretTopping = deretTopping.substring(0, pjgDeret - 1);
      deretTopping.toCharArray(deretBuf, pjgDeret + 1);
      int pjgDeretLos = deretLossing.length();
      deretLossing = deretLossing.substring(0, pjgDeretLos - 1);
      deretLossing.toCharArray(deretLosBuf, pjgDeretLos + 1);
//      char tokenBufX[8];
     
      deretTopping.toCharArray(deretBufX, pjgDeret + 1);
      deretLossing.toCharArray(deretLosBufX, pjgDeretLos + 1);

      itoa(nomTank, tankBuf, 10);
      //itoa(qtyPam, paBuf, 10); //qtyPamp
      int pjgDeretQty = haloQty.length();
      haloQty.toCharArray(paBuf, pjgDeretQty + 1);
      Serial.println("prev");
      Serial.println(deretTopping);
      Serial.println(pjgDeret);
    }

  if ((reqData >= 1) && (reqData < 3)) { //startup (1) dan upload topping(2)
    sprintf(pageAdd, "/adisucipto/insert_top.php?ref=%s&req=%s&tt=%s", refBuf, qtyBuf, actBuf);
  } else if (reqData == 3) { //setup tangki topping dan lossing (3)
    sprintf(pageAdd, "/adisucipto/edit_tanktop.php?token=%s&deretTop=%s&deretLos=%s", tokenBuf, deretBuf, deretLosBuf);
  } else if ((reqData == 3)&&((countRetry != 0))) { //setup tangki topping dan lossing (3)
    sprintf(pageAdd, "/adisucipto/edit_tanktop.php?token=%s&deretTop=%s&deretLos=%s", tokenBuf, deretBufX, deretLosBufX);
  }else if (reqData == 4) { //setup pumpable tangki
    sprintf(pageAdd, "/adisucipto/edit_tankpa.php?token=%s&tank=%s&pa=%s", tokenBuf, tankBuf, paBuf);
  }
  Serial.println(pageAdd);
  lcd.clear();
  if (!getPage(server, serverPort, pageAdd)) {
    Serial.print(F("Fail "));
    countRetry++;
    if (countRetry == 5) { //jika lebih dari3x, gagal
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Gagal");
      lcd.setCursor(0, 1);
      lcd.print("Ulangi lagi");
      countRetry = 0;
      delay(1000);
      goHome();
    }else{
      sendDataToWeb();
    }
    
    
    
  } else {

    if (reqData == 1) { //load data
      for (int i = 50; i <= 100; i++) {
        lcd.setCursor(0, 0);
        lcd.print("Loading Data :");
        lcd.print(i);
        lcd.print("%");
        lcd_percentage(i, 0, 20, 3);
        delay(10);
      }
    } else if ((reqData == 2) || (reqData == 3) || (reqData == 4)) { //kirim data
      for (int i = 50; i <= 100; i++) {
        lcd.setCursor(0, 0);
        lcd.print("Sending Data :");
        lcd.print(i);
        lcd.print("%");
        lcd_percentage(i, 0, 20, 3);
        delay(10);
      }
    }

    Serial.print(F("Pass "));
    countRetry = 0;
  }
  delay(2000);
  reqData = 0;
}

void sendingAnim() {
  //  lcd.setCursor(0,0);
  //  lcd.print("TOPPING SENDING");
  lcd.setCursor(0, 3);
  for (int loadbar = 0; loadbar < 20; loadbar++) {
    lcd.setCursor(loadbar, 3);
    lcd.write(6);
    delay(10);
    lcd.setCursor(loadbar, 3);
    lcd.write(7);
    delay(10);
    lcd.setCursor(loadbar, 3);
    lcd.write(8);
    delay(10);
    lcd.setCursor(loadbar, 3);
    lcd.write(9);
    delay(10);
    lcd.setCursor(loadbar, 3);
    lcd.write(10);
    delay(10);
  }
  delay(500);

}


void parsingData() {
  //parsing result:
  //*T1: 9000,T2:174165,T3: 7000,T4: 353,T5: 5000,T6: 4000,T7: 3000,T8: 2000,TOP:4-3|,LOS:1-2-5-6-7-8$,ACTIVE:4,R6: 900^,R3: 690~,R5: 300@,R2: 1000#

  int addr_startT01 = dataIn.indexOf("*");
  int btsTop = dataIn.indexOf("|");
  int btsLos = dataIn.indexOf("$");
  int btsAct = dataIn.indexOf("%");
  int btsHis1 = dataIn.indexOf("^");
  int btsHis2 = dataIn.indexOf("~");
  int btsHis3 = dataIn.indexOf("@");
  int btsHis4 = dataIn.indexOf("#");

  int btsT01 = addr_startT01 + 10;
  int addr_startT02 = addr_startT01 + 10;
  int btsT02 = addr_startT01 + 20;
  int addr_startT03 = addr_startT02 + 10;
  int btsT03 = addr_startT02 + 20;
  int addr_startT04 = addr_startT03 + 10;
  int btsT04 = addr_startT03 + 20;

  int addr_startT05 = addr_startT04 + 10;
  int btsT05 = addr_startT04 + 20;

  int addr_startT06 = addr_startT05 + 10;
  int btsT06 = addr_startT05 + 20;
  int addr_startT07 = addr_startT06 + 10;
  int btsT07 = addr_startT06 + 20;
  int addr_startT08 = addr_startT07 + 10;
  int btsT08 = addr_startT07 + 20;

  int addr_startTop = addr_startT08 + 10;
  int addr_startLos = btsTop + 1;
  int addr_startActTop = btsLos + 1;
  int batasActTop = addr_startActTop + 8;

  P1 = dataIn.substring(addr_startT01 + 1, btsT01);
  P1 = "01:" + P1 + "#";
  P2 = dataIn.substring(addr_startT02 + 1, btsT02);
  P2 = "02:" + P2 + "#";
  P3 = dataIn.substring(addr_startT03 + 1, btsT03);
  P3 = "03:" + P3 + "#";
  P4 = dataIn.substring(addr_startT04 + 1, btsT04);
  P4 = "04:" + P4 + "#";
  P5 = dataIn.substring(addr_startT05 + 1, btsT05); //
  P5 = "05:" + P5 + "#";
  P6 = dataIn.substring(addr_startT06 + 1, btsT06);
  P6 = "06:" + P6 + "#";
  P7 = dataIn.substring(addr_startT07 + 1, btsT07);
  P7 = "07:" + P7 + "#";
  P8 = dataIn.substring(addr_startT08 + 1, btsT08);
  P8 = "08:" + P8 + "#";

  Top = dataIn.substring(addr_startTop + 1, btsTop);
  String TopX = Top; //TOP:5-1-2-3#
  int CekPjgTop1;
  CekPjgTop1 = TopX.length();
  ////09:TOP:1-2#
  //jika lebih dari 9
  if (CekPjgTop1 > 9) {
    Top = TopX.substring(0, 9);
    Top = "09:" + Top + " #"; //09:TOP:1-2-3-4-5#
    Serial.println(Top);

    Top2 = TopX.substring(10, CekPjgTop1);
    Top2 = "10:  " + Top2 + "      #"; //jika lebih dari 3 tangki
    Serial.println(Top2);
  } else {
    Top = "09:" + Top + "        #"; //09:TOP:1-2#
    Top2 = "10:         #"; //9char
  }

  Los = dataIn.substring(addr_startLos + 1, btsLos);
  String LosX = Los;
  int CekPjgLos1;
  CekPjgLos1 = LosX.length();
  //jika lebih dari 9
  if (CekPjgLos1 > 9) {
    Los = LosX.substring(0, 9);
    Los = "11:" + Los + " #"; //09:TOP:1-2-5#
    Los2 = LosX.substring(10, CekPjgLos1); //LOS
    Los2 = "12:  " + Los2 + "      #"; //jika lebih dari 3 tangki
  } else {
    Los = "11:" + Los + "        #"; //09:TOP:1-2#
    Los2 = "12:         #";
  }
  //Los = "11:"+Los;
  //Los2 = "12:"+Los2; //jika lebih dari 3 tangki

  //His1,His2,His3,His4,ActTop

  His1 = dataIn.substring(batasActTop + 2, btsHis1);
  His1 = "13:" + His1 + " #"; //R24
  His2 = dataIn.substring(btsHis1 + 2, btsHis2);
  His2 = "14:" + His2 + " #";
  His3 = dataIn.substring(btsHis2 + 2, btsHis3);
  His3 = "15:" + His3 + " #";
  His4 = dataIn.substring(btsHis3 + 2, btsHis4);
  His4 = "16:" + His4 + " #";

  ActTop = dataIn.substring(addr_startActTop + 1, addr_startActTop + 9); //ACTIVE:4
  String nomActiv = ActTop.substring(8, ActTop.length() - 1);
  ActTopOk = nomActiv.toInt();
  Serial.println("nomor tangki aktif ");
  Serial.println(ActTopOk);
  ActTop = "17:" + ActTop + "#";

  Serial.println("Kirim ke running text..");
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Writing Data :");
  delay(5000);
  for (int i = 0; i <= 50; i++) {
    lcd.setCursor(0, 0);
    lcd.print("Writing Data :");
    lcd.print(i);
    lcd.print("%");
    lcd_percentage(i, 0, 10, 3);
    // delay(10);
  }
  Serial1.println(P1); Serial.println(P1);
  delay(1000);
  Serial1.println(P2); Serial.println(P2);
  delay(1000);
  Serial1.println(P3); Serial.println(P3);
  delay(1000);
  Serial1.println(P4); Serial.println(P4);
  delay(1000);
  Serial1.println(P5); Serial.println(P5);
  delay(1000);
  Serial1.println(P6); Serial.println(P6);
  delay(1000);
  Serial1.println(P7); Serial.println(P7);
  delay(1000);
  Serial1.println(P8); Serial.println(P8);
  delay(1000);
  Serial1.println(Top); Serial.println(Top);
  delay(1000);
  for (int i = 50; i <= 80; i++) {
    lcd.setCursor(0, 0);
    lcd.print("Writing Data :");
    lcd.print(i);
    lcd.print("%");
    lcd_percentage(i, 0, 18, 3);
    delay(10);
  }
  Serial1.println(Top2); Serial.println(Top2);
  delay(1000);
  Serial1.println(Los); Serial.println(Los);
  delay(1000);
  Serial1.println(Los2); Serial.println(Los2);
  delay(1000);
  Serial1.println(His1); Serial.println(His1);
  delay(1000);
  Serial1.println(His2); Serial.println(His2);
  delay(1000);
  Serial1.println(His3); Serial.println(His3);
  delay(1000);
  Serial1.println(His4); Serial.println(His4);
  delay(1000);
  Serial1.println(ActTop); Serial.println(ActTop);
  delay(1000);
  for (int i = 80; i <= 100; i++) {
    lcd.setCursor(0, 0);
    lcd.print("Writing Data :");
    lcd.print(i);
    lcd.print("%");
    lcd_percentage(i, 0, 20, 3); //mulai 80% - 100%, ampe posisi 20char
    delay(10);
  }
  lcd.clear();
}

void lcd_percentage(int percentage, int cursor_x, int cursor_x_end, int cursor_y) {

  int calc = (percentage * cursor_x_end * 5 / 100) - (percentage * cursor_x * 5 / 100);
  while (calc >= 5) {
    lcd.setCursor(cursor_x, cursor_y);
    //    lcd.write((byte)4);
    lcd.write(10);
    //    lcd.print(".");
    calc -= 5;
    cursor_x++;
  }
  while (calc >= 4 && calc < 5) {
    lcd.setCursor(cursor_x, cursor_y);
    lcd.write(10);
    //lcd.print(".");
    calc -= 4;

  }
  while (calc >= 3 && calc < 4) {
    lcd.setCursor(cursor_x, cursor_y);
    lcd.write(10);
    //lcd.print(".");
    calc -= 3;
  }
  while (calc >= 2 && calc < 3) {
    lcd.setCursor(cursor_x, cursor_y);
    lcd.write(10);
    //lcd.print(".");
    calc -= 2;
  }
  while (calc >= 1 && calc < 2) {
    lcd.setCursor(cursor_x, cursor_y);
    lcd.write(10);
    //lcd.print(".");
    calc -= 1;
  }

}


void goHome() {
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("... Back to home");
  delay(1000);
  lcd.clear();
  Serial.print("menu ... " + menu);
  menu = 0; submenu = 0; first = 0; second = 0; nomRef = 0; qtyTop = 0; qtyPam = 0; nomTank = 0;
  cancel = 0; deretTopping = ""; deretLossing = ""; deretKedua = ""; 
}

