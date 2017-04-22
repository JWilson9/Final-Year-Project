package dynamicTT;

import java.io.FileWriter;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import com.mysql.jdbc.*;


public class javaToMySQl {
	public static void main(String[] args) throws IOException {
	
		 String url = "jdbc:mysql://localhost:3306/";
		//String url = "";
		// String dbName = "demo";
		String driver = "com.mysql.jdbc.Driver";
		String password = "";
		String user = "root";
		FileWriter writeToClass = new FileWriter("classRoom.csv");

		try {
			Class.forName(driver).newInstance();
			Connection con = DriverManager.getConnection(url, user, password);
			
			
			Statement stt = con.createStatement();
			stt.execute("USE fyp");
			
			
			//ResultSet res = stt.executeQuery("SELECT * FROM teacher");
			ResultSet res2 = stt.executeQuery("SELECT * FROM teacher");
			
			while(res2.next()){
				System.out.println(res2.getString("id") + "," +res2.getString("t_name") +  "," + res2.getString("subject"));
				//writeToClass.append(res.getString("RoomName") + "," +res.getString("TotalStudents") +  "," + res.getString("StudGroup") + "\n");
				//System.out.printf(res2.getString("id"), res2.getString("t_name"), res2.getString("subject"));
			}
			
			con.close();
		} catch (Exception e) {
			e.printStackTrace();
		}
		finally{
			try {
				writeToClass.close();
				
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
	}
}
