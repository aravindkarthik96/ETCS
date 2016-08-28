/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package rfid_final;

import com.fazecast.jSerialComm.*;
import java.io.*;
import java.util.Scanner;
import java.sql.*;
import java.util.Calendar;

/**
 *
 * @author aravind karthik
 */
public class RFID_final {

    /**
     * @param args the command line arguments
     * @throws java.lang.Exception
     */ 
    public static void main(String[] args) throws Exception {
        SerialPort[] ports = SerialPort.getCommPorts();
        System.out.println("Select a port:");
        int i = 1;
        for (SerialPort port : ports) {
            System.out.println(i++ + ": " + port.getSystemPortName());
        }
        Scanner s = new Scanner(System.in);
        int chosenPort = s.nextInt();

        SerialPort serialPort = ports[chosenPort - 1];
        if (serialPort.openPort()) {
            System.out.println("Port opened successfully.");
        } else {
            System.out.println("Unable to open the port.");
            return;
        }
        Connection cn = null;
        Statement st = null;
        ResultSet rs = null;
        Class.forName("com.mysql.jdbc.Driver");
        cn = DriverManager.getConnection("jdbc:mysql://portrayme.com:3306/portraym_ETCS", "portraym_harshit", "hello19");
        st = cn.createStatement();
        while (true) {
            serialPort.setComPortParameters(9600, 8, 1, SerialPort.NO_PARITY);
            String value = " ";
            int status =0;
            Scanner data = new Scanner(serialPort.getInputStream());
            while (data.hasNextLine()) {
                value = data.nextLine();
                String query = "SELECT vehicleno,type FROM vehicle where UID ='" + value + "'";
                rs = st.executeQuery(query);
                PrintWriter op = new PrintWriter(serialPort.getOutputStream());
                int vno;
                String typ;
                while (rs.next()) {
                    System.out.println(rs.getString("vehicleno"));
                    if (rs.getString("vehicleno").length()==4) {
                        op.print("x");
                        op.flush();
                        vno=Integer.parseInt(rs.getString("vehicleno"));
                        typ=rs.getString("type");
                        Calendar calendar = Calendar.getInstance();
                        java.util.Date now = calendar.getTime();
                        java.sql.Timestamp currentTimestamp = new java.sql.Timestamp(now.getTime());
                        st = cn.createStatement();
                        query = "INSERT INTO log (log_no,tagno, readerno, time,type) VALUES ( NULL,"+vno+",4,'"+currentTimestamp+"','"+typ+"')";
                        st.executeUpdate(query);
                    }
                }
            }
        }
    }
}

