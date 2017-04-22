package dynamicTT;



import java.io.IOException;
import java.sql.SQLException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import com.mysql.jdbc.*;

public class TimeTableMain {

	/**
	 * @param args
	 * @throws IOException
	 */
	private static String[] savedArgs;
	
	public static String[] getArgs() {
		return savedArgs;
	}
	
	public static void main(String[] args) throws IOException, InstantiationException, IllegalAccessException, ClassNotFoundException, SQLException {
		// TODO Auto-generated method stub

		/*if (args[0].equalsIgnoreCase("-t")) {
			// System.out.println("this is the argument passed: " + args[1]);
			savedArgs = args;
			
			//cmdLineArgs cla = new cmdLineArgs();
	        //cla.printArgs();

		}*/
		
		Initialization init = new Initialization();
		
		init.readInput();
		
		// call it here maybe (insert into database)
		GeneticAlgorithm GA = new GeneticAlgorithm();
		
		GA.insertDatabase();
		
	}
	
	
}
