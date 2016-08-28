/*
  ----------------------------------------------------------------------------- Nicola Coppola
   Typical pin layout used:
   -----------------------------------------------------------------------------------------
               MFRC522      Arduino       Arduino   Arduino    Arduino          Arduino
               Reader/PCD   Uno           Mega      Nano v3    Leonardo/Micro   Pro Micro
   Signal      Pin          Pin           Pin       Pin        Pin              Pin
   -----------------------------------------------------------------------------------------
   RST/Reset   RST          9             5         D9         RESET/ICSP-5     RST
   SPI SS      SDA(SS)      10            53        D10        10               10
   SPI MOSI    MOSI         11 / ICSP-4   51        D11        ICSP-4           16
   SPI MISO    MISO         12 / ICSP-1   50        D12        ICSP-1           14
   SPI SCK     SCK          13 / ICSP-3   52        D13        ICSP-3           15

   The reader can be found on eBay for around 5 dollars. Search for "mf-rc522" on ebay.com.
*/
//include synchronous peripheral interface  
#include <SPI.h>
//include library for rfid reader MFRC522
#include <MFRC522.h>
//define slave select pin as 10 
#define SS_PIN 10
//define reset pin as 9
#define RST_PIN 9

// Create MFRC522 instance.
MFRC522 mfrc522(SS_PIN, RST_PIN);        
MFRC522::MIFARE_Key key;

//runs once when the arduino is turned on
void setup() {
  //initialize serial communication at baud rate 9600 (bits per second)
  Serial.begin(9600); 
  //do nothing until serial is connected with the computer
  while (!Serial); 
  // Initialize SPI bus
  SPI.begin();               
  // Initialize MFRC522 card
  mfrc522.PCD_Init();        
  //Set pin 6,5,4 as outputs for LEDs (traffic signals)
  //green
  pinMode(6,OUTPUT);
  //red
  pinMode(5,OUTPUT);
  //orange
  pinMode(4,OUTPUT);
}

//runs as an endless loop
void loop() {
//check if data is available on the serial buffer
  if (Serial.available() > 0) {
//read data and check if its ‘x’ without flushing the buffer
    if (Serial.peek() == 'x') {
//read and clear data off the buffer so that it can be used to read more data
      Serial.read();
//run the emergency sequence method
      emergencyseq();
    } 
//if data is not equal to ‘x’ do nothing
    else{}
  }
//if no data is available on the serial buffer continue the regular sequence
  else{
       regularseq();
    }
    // Look for new RFID tags, and select one if present
    if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial() ) {
//prevent rest of the code to execute if the card is not found
      return;
    }
    else {
//initialize uid variable to store the uid
      String uid = "";
//retrieve byte by byte value using loop and append it to the uid variable
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        uid = uid + (mfrc522.uid.uidByte[i]);
      }
//print the uid variable into serial
      Serial.println(uid);
//create a delay so that the same card doesn't get read twice while it's moving ahead
      delay(1000);
    } 

  }

//emergency sequence
  void emergencyseq(){
//turn off red and turn on orange
      digitalWrite(5,LOW);
      digitalWrite(4,HIGH);
//wait for 1 second
      delay(1000);
//turn off orange and turn on green
      digitalWrite(4,LOW);
      digitalWrite(6,HIGH);
//wait for 5 seconds
      delay(5000);
//turn off green and turn on orange
      digitalWrite(6,LOW);
      digitalWrite(4,HIGH);
//wait 1 second
      delay(1000);
//turn off orange and exit method
      digitalWrite(4,LOW);
    }
//regular sequence
  void regularseq(){
//turn on the red signal
    digitalWrite(5,HIGH);
  }
