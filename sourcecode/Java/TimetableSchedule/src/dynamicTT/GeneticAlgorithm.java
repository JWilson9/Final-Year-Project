package dynamicTT;

import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormatSymbols;
import java.io.FileWriter;
import java.util.*;
import com.mysql.jdbc.*;

public class GeneticAlgorithm {

	private static TimeTable FittestTimetable;
	private static int minimum = 1000;
	private static ArrayList<String> weekDayNames = new ArrayList<>();
	private static ArrayList<String> ClassTimes = new ArrayList<>();

	public static void populationAccepter(
			ArrayList<TimeTable> timeTableCollection) throws IOException {
		// randomly got population from the initialization class
		for (Iterator<TimeTable> iterator = timeTableCollection.iterator(); iterator
				.hasNext();) {
			TimeTable timeTable = iterator.next();
			// fitness function class
			fitness(timeTable);
		}
		// creating the week
		createWeek();
		// creating the lecture times
		createLectureTime();
		// selection function called passing through the arraylist of timetables
		selection(timeTableCollection);
	}

	// Create the week
	private static void createWeek() {
		// Use DateFormatSymbols for for encapsulating localizable date-time
		// formatting data
		String[] weekDaysName = new DateFormatSymbols().getWeekdays();
		int i;
		// for loop iterating through the weekdays
		for (i = 1; i < weekDaysName.length; i++) {
			// printing out the weekdays
			//System.out.println("weekday = " + weekDaysName[i]);

			if (!(i == Calendar.SUNDAY) && !(i == Calendar.SATURDAY))
				// add days of the week that are not Sunday & Saturday
				weekDayNames.add(weekDaysName[i]);
		}
	}

	// }
	// creating the timetable times between the hours of 9AM and 4PM
	private static void createLectureTime() {
		// start and finish times initialized 
		int start = 9;
		int finish = 16;
		// class times added to the attaylist 
		for (int i = start; i < finish; i++) {
			ClassTimes.add(i + ":00" + " TO " + (i + 1) + ":00");
		}
	}

	// selection function (with list of timetables from population accepter function
	public static void selection(ArrayList<TimeTable> timetables)
			throws IOException {
		// number of iterations used in the algorithm
		int iterations = 60;
		int i = 1;
		// initialize timetable arraylist mutants
		ArrayList<TimeTable> mutants = new ArrayList<>();
		// make an iterator for the timetable
		Iterator<TimeTable> timetabletItr = timetables.iterator();
		//giving a score to each timetable
		while (timetabletItr.hasNext()) {
			// call the fitness function for every timetable
			fitness(timetabletItr.next());
		}
		while (iterations != 0) {
			// init a new timetable iterator
			Iterator<TimeTable> timetableIterator = timetables.iterator();
			
			while (timetableIterator.hasNext()) {
				TimeTable timeTable = timetableIterator.next();
				int score = timeTable.getFittness();
				// executes once the score is smaller than minimum
				// we are trying to get the lowest score
				if (score < minimum) {
					// assigning score to minimum
					minimum = score;
					// getting the best timetable
					FittestTimetable = timeTable;
				
					
				}
			}// end while
			
				//System.out.println("Iteration :" + i);
				i++;
				iterations--;

				for (Iterator<TimeTable> iterator = timetables.iterator(); iterator
						.hasNext();) {
					// assign timetable1 to the next timetable in the iterator
					TimeTable timetable1 = iterator.next();
					
					// call crossover function
					TimeTable childTimetable = crossOver(timetable1);
					// call Mutation function
					TimeTable mutant = Mutation(childTimetable);
					// add the timetable 
					mutants.add(mutant);
				}
				// clearing the timetables, as adding the timetable mutants below
				timetables.clear();
				// for loop, iter through the no. of timetables
				// fitness function called for each timetable
				for (int j = 0; j < mutants.size(); j++) {
					// fitness function call passing through each timetable (mutant) at a time
					fitness(mutants.get(j));
					timetables.add(mutants.get(j));
				}
				// clearing the timetable arraylist
				mutants.clear();
			
		}
		
	}
	
	// fitness function accessing a timetable
	public static void fitness(TimeTable timetable) {
		// init an arraylist of all the rooms in the timetable
		ArrayList<ClassRoom> rooms = timetable.getRoom();
		// init an iterator for the rooms arraylist
		Iterator<ClassRoom> roomIterator1 = rooms.iterator();
		// iterating until has no more rooms
		while (roomIterator1.hasNext()) {
			int score = 0;
			// init variable room which takes the value of the next room stored
			// in the iterator
			ClassRoom room1 = roomIterator1.next();
			Iterator<ClassRoom> roomIterator2 = rooms.iterator();
			// keep looping through until no rooms left
			while (roomIterator2.hasNext()) {
				// init another variable room which takes the value of the next
				// room stored in the iterator
				ClassRoom room2 = roomIterator2.next();
				// if room2 in not the same as room1 then if is executed
				if (room2 != room1) {
					// Arraylist of the days for room1 and room2
					ArrayList<Day> weekdays1 = room1.getWeek().getWeekDays();
					ArrayList<Day> weekdays2 = room2.getWeek().getWeekDays();
					// Creating an iterator for the days of the week from the above arraylist
					Iterator<Day> daysIterator1 = weekdays1.iterator();
					Iterator<Day> daysIterator2 = weekdays2.iterator();
					// continue the while loop while each day iterator has a
					// value in its list
					while (daysIterator1.hasNext() && daysIterator2.hasNext()) {
						// declaring the day with the next value in the iterator
						// eg day1 -> mon, day2 ->tues
						Day day1 = daysIterator1.next();
						Day day2 = daysIterator2.next();
						// Getting the timeslots from day1 and day2
						ArrayList<TimeSlot> timeslots1 = day1.getTimeSlot();
						ArrayList<TimeSlot> timeslots2 = day2.getTimeSlot();
						// creating an iterator for the timeslots
						Iterator<TimeSlot> timeslotIterator1 = timeslots1
								.iterator();
						Iterator<TimeSlot> timeslotIterator2 = timeslots2
								.iterator();
						// while the timeslots have a value
						while (timeslotIterator1.hasNext()
								&& timeslotIterator2.hasNext()) {
							// declaring the timeslot 
							TimeSlot lecture1 = timeslotIterator1.next();
							TimeSlot lecture2 = timeslotIterator2.next();
							// while the lectures are not null (have a value)
							if (lecture1.getLecture() != null
									&& lecture2.getLecture() != null) {
								// get the professors name for lecture1
								String professorName1 = lecture1.getLecture()
										.getProfessor().getProfessorName();
								// get the professors name for lecture2
								String professorName2 = lecture2.getLecture()
										.getProfessor().getProfessorName();
								// get the student group for lecture1
								String stgrp1 = lecture1.getLecture()
										.getStudentGroup().getName();
								// get the student group for lecture2
								String stgrp2 = lecture2.getLecture()
										.getStudentGroup().getName();
								// if the student groups -  professors are the same increment
								// the score by 1
								if (stgrp1.equals(stgrp2)
										|| professorName1
												.equals(professorName2)) {
									score = score + 1;
								}
								// arraylist containing the subject combination of the student group
								ArrayList<Combination> stcomb1 = lecture1
										.getLecture().getStudentGroup()
										.getCombination();
								// initialize a iterator for the subjects combination
								Iterator<Combination> stcombItr = stcomb1
										.iterator();
								// while the subject iterator has a next value
								while (stcombItr.hasNext()) {
									// getting the students subject combination and assigning it to lecture
									// if the 2 student groups subject combination are the same increment the score
									if (lecture2.getLecture().getStudentGroup()
											.getCombination()
											.contains(stcombItr.next())) {
										
										score = score + 1;
										// break out of the if statement
										break;
									}
								}

							}
						}
					}
				}
			}
			// setting the score for the timetable
			timetable.setFittness(score);

		}
		

	}

	private static TimeTable Mutation(TimeTable parentTimetable) {
		// declaring the parent timetable
		TimeTable mutantTimeTable = parentTimetable;
		// init the random number generator
		Random randomNumGen = new Random();
	
		ArrayList<ClassRoom> presentClassroom = mutantTimeTable.getRoom();
		for (Iterator<ClassRoom> iterator = presentClassroom.iterator(); iterator
				.hasNext();) {
			ClassRoom classRoom = iterator.next();

			// init 2 variables to be randomized
			// int ran1, ran2;
			int ran1 = randomNumGen.nextInt(5), ran2 = -1;
			// int ran2 = -1;
			while (ran1 != ran2) {
				ran2 = randomNumGen.nextInt(5);
			}
			//
			ArrayList<Day> weekDays = classRoom.getWeek().getWeekDays();
			// getting a random day for day1 and day2
			Day day1 = weekDays.get(ran1);
			Day day2 = weekDays.get(ran2);

			ArrayList<TimeSlot> timeSlotsOfday1 = day1.getTimeSlot();
			ArrayList<TimeSlot> timeSlotsOfday2 = day2.getTimeSlot();
			// exchanging the times slots between day 1 and day 2
			day1.setTimeSlot(timeSlotsOfday2);
			day2.setTimeSlot(timeSlotsOfday1);

			// break out of the for loop
			// so the days wont be exchanged in pairs ie monday + tuesday
			break;

		}

		return mutantTimeTable;
	}

	/*
	 * this function is basically shuffling the time slots for the day. The day
	 * is picked from a random of 5 days.
	 */
	private static TimeTable crossOver(TimeTable fatherTimeTable) {
		// declare a random number generator 
		Random randomGenerator = new Random();
		// creating an iterator for the parent timetable classrooms
		Iterator<ClassRoom> parentTimeTableClassRooms = fatherTimeTable
				.getRoom().iterator();
		while (parentTimeTableClassRooms.hasNext()) {
			// give the room the next room in the iterator
			ClassRoom room = parentTimeTableClassRooms.next();
			// create an arraylist of the days of the week
			ArrayList<Day> days = room.getWeek().getWeekDays();
			int i = 0;
			while (i < 5) {
				int rand = randomGenerator.nextInt(5);
				// assign a day at random
				Day day = days.get(rand);
				// shuffling the time slot for that day
				Collections.shuffle(day.getTimeSlot());
				i++;
			}
			

		}
		// returning the father timetable 
		return fatherTimeTable;
	}

	
	
	
	public static void insertDatabase() throws IOException, InstantiationException, IllegalAccessException, ClassNotFoundException, SQLException{
		// insert timeslot, subject name, teacher name, student group
		//int i = 0;
		// getting all the rooms in the database
		ArrayList<ClassRoom> allrooms = FittestTimetable.getRoom();
		// iterator for the rooms
		Iterator<ClassRoom> allroomsIterator = allrooms.iterator();
		// connection to the MYSQL database
		String url = "jdbc:mysql://localhost:3306/";
		String driver = "com.mysql.jdbc.Driver";
		String password = "";
		String user = "root";
		// declaring a statement used for executing SQL statements in Java
		Statement stmt = null;
		Class.forName(driver).newInstance();
		Connection con = DriverManager.getConnection(url, user, password);			
		Statement stt = con.createStatement();
		// use the schema from MYSQL
		stt.execute("USE fyp");
		
		
		try {
			// deleting all of the data from the tables in the database
			Statement statement = con.createStatement();
			statement.executeUpdate("TRUNCATE timetable");
			statement.executeUpdate("TRUNCATE day");
			statement.executeUpdate("TRUNCATE timeslot");
			statement.executeUpdate("TRUNCATE testtimetable");

			Iterator<String> lectTimeItr1 = ClassTimes.iterator();
			// while all the all rooms iterator has a next value
			while (allroomsIterator.hasNext()) {
				ClassRoom room = allroomsIterator.next();
				ArrayList<Day> weekdays = room.getWeek().getWeekDays();
				Iterator<Day> daysIterator = weekdays.iterator();
				// lecture times (used for inserting the timeslots)
				Iterator<String> lectTimeItr = ClassTimes.iterator();
				// getting the room number of the current room
				String testRoomNumber = room.getRoomNo();
				int i = 0;
								
				while (daysIterator.hasNext()) {
					Day day = daysIterator.next();
					// getting the timeslot for the specific day
					ArrayList<TimeSlot> timeslots = day.getTimeSlot();
					// assigning the lecture times from the class times iterator
					lectTimeItr = ClassTimes.iterator();
					
					for (int k = 0; k < timeslots.size(); k++) {
						
						if (k == 3) {
							
							PreparedStatement pstmt = con.prepareStatement("INSERT INTO timetable (roomName,timeslot,day,subject,teacherName,studentGroup) VALUE (?,?,?,?,?,?)");
							pstmt.setString(1, room.getRoomNo());
							System.out.println("" + room.getRoomNo());
							pstmt.setString(2, lectTimeItr.next() );
							pstmt.setString(3, weekDayNames.get(i));
							pstmt.setString(4, "lunch");
							pstmt.setString(5, "lunch");
							pstmt.setString(6, "lunch");
							pstmt.executeUpdate();
							
						}
						TimeSlot lecture = timeslots.get(k);
						
						if (lecture.getLecture() != null) {					
							PreparedStatement pstmt = con.prepareStatement("INSERT INTO timetable (roomName,timeslot,day,subject,teacherName,studentGroup) VALUE (?,?,?,?,?,?)");
							pstmt.setString(1, testRoomNumber);
							pstmt.setString(2, lectTimeItr.next() );
							pstmt.setString(3, weekDayNames.get(i));
							pstmt.setString(4, lecture.getLecture().getSubject());
							pstmt.setString(5, lecture.getLecture().getProfessor().getProfessorID());
							pstmt.setString(6, lecture.getLecture().getStudentGroup().getName().split("/")[0] );
							
							pstmt.executeUpdate();
						}
		
						else {
						
							PreparedStatement pstmt = con.prepareStatement("INSERT INTO timetable (roomName,timeslot,day,subject,teacherName,studentGroup) VALUE (?,?,?,?,?,?)");
							pstmt.setString(1, testRoomNumber);
							pstmt.setString(2, lectTimeItr.next() );
							pstmt.setString(3, weekDayNames.get(i));
							pstmt.setString(4, "no class");
							pstmt.setString(5, "no class");
							pstmt.setString(6, "no class");
							pstmt.executeUpdate();
						}
					}
					i++;
				}// end while days iterator 

			}// end while for room iterator
			lectTimeItr1 = ClassTimes.iterator();
			for (int k = 0; k < 7; k++) {
				
				PreparedStatement pstmt = con.prepareStatement("INSERT INTO timeslot (timeslot) VALUE (?)");
				pstmt.setString(1, lectTimeItr1.next());
				pstmt.executeUpdate();			
						
			}// end for insert into time slot table
			
			int i = 0;
			for (int k = 0; k < 5; k++) {
				
					PreparedStatement pstmt = con.prepareStatement("INSERT INTO day (dayName) VALUE (?)");
					pstmt.setString(1, weekDayNames.get(i));
					pstmt.executeUpdate();			
					i++;
						
			}// end for insert into time slot table
			
		}catch (Exception e) {
			e.printStackTrace();
		}finally{
			// closing the database connection
			con.close();
		}
		
		
	}
	

	
}
