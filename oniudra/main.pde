// define variables:
int adcVar = 0;
int inByte = 0;
int tcpPin = 13;
int connected = 0;
long measurementPeriod = 60000; //i.e.: ~60 seconds between measurements

void setup(){

  Serial.begin(9600);  // start serial port at 9600 bps:
  
  delay(2000);// pause to let Xport boot up:
}

void loop(){
    blinkie(5, 100);

    // if you're connected to the server, then 
    // make a HTTP call.  If not, then connect
    // to the server:

    if (connected == 1){
     adcVar = analogRead(0);  // read sensors, convert to bytes:
   
     http_request();   // send HTTP GET request for php script:
    } else {
    
     xport_connect();  // attempt to connect to the server:
    }

    digitalWrite(tcpPin, connected);
    // pause so we're not overwhelming the server:
    delay(measurementPeriod/2); 
    //Serial.print("After 3 second delay in main loop");
}

void xport_connect(){
    // turn off LED to indicate HTTP GET is in progress:
    digitalWrite(tcpPin, LOW);

    //if (Serial.available() > 0) {
    // get incoming byte:
      inByte = Serial.read();
      //Serial.print(inByte);

      // wait for a "C" byte to come back:
      while (inByte != 67){
        //Serial.print("Waiting for xport to send back C");
        Serial.print("C128.122.253.189/80");
        Serial.print(10, BYTE);
        delay(100);
        inByte = Serial.read();
      }

    connected = 1;    

}

void http_request(){
    Serial.print("GET /~ja771/sensorworkshop/datalogger/sql_datalog.php?action=insert&");
    Serial.print("sensorValue=");
    Serial.print(adcVar,DEC);
    Serial.print(" HTTP/1.1");
    Serial.print(10, BYTE);
    Serial.print("HOST: gorato.com");
    Serial.print(10, BYTE);
    Serial.print(10, BYTE);

    //we should really be waiting for the return '0' here
    //from the script, but it just never seemed to come,
    //hanging the program in a while loop like the one above
    //so instead we just delay until the Xport lets go of it's connection
    //and then we try again

    delay(measurementPeriod/2);
    connected = 0;
}

void blinkie(int number, int speed){
  int i;
  for (i=0; i<number; i++){
    digitalWrite(tcpPin, HIGH);
    delay(speed);
    digitalWrite(tcpPin, LOW);
    delay(speed);

  }
}
