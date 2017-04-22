package dynamicTT;



import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Iterator;
import java.util.ListIterator;
import java.util.Scanner;

public class Initialization {

	private ArrayList<Subject> subjects = new ArrayList();
	private ArrayList<Professor> professors = new ArrayList();
	private ArrayList<TimeTable> timetables = new ArrayList();
	private ArrayList<Lecture> classes = new ArrayList<>();
	private ArrayList<Combination> combinations = new ArrayList<>();
	private ArrayList<Course> course = new ArrayList<>();
	ArrayList<String> attributes = new ArrayList<>();
	ArrayList<String> TeacherAtt = new ArrayList<>();
	ArrayList<String> subjectAtt = new ArrayList<>();
	
	ArrayList<ClassRoom> classroom = new ArrayList<>();
	
	// reads input from a file.

	public void readInput() throws IOException {
		
		String url = "jdbc:mysql://localhost:3306/";
		String driver = "com.mysql.jdbc.Driver";
		String password = "";
		String user = "root";
		
		TimeTable timetb1 = new TimeTable(classroom, classes);
		

		try {
			Class.forName(driver).newInstance();
			// driver connection
			Connection con = DriverManager.getConnection(url, user, password);
			
			
			Statement stt = con.createStatement();
			Statement stt2 = con.createStatement();
			Statement stt3 = con.createStatement();
			Statement teacherStatement = con.createStatement();
			Statement subjectStatement = con.createStatement();
			Statement joinTeacher = con.createStatement();
			Statement classStatement = con.createStatement();
			Statement testTeacher = con.createStatement();
			Statement teacherStatement2 = con.createStatement();
			Statement subjectSelect = con.createStatement();
			// here is where the argument is going to be passed through
			stt.execute("USE fyp");
			stt2.execute("USE fyp");
			stt3.execute("USE fyp");
			teacherStatement.execute("USE fyp");
			subjectStatement.execute("USE fyp");
			joinTeacher.execute("USE fyp");
			classStatement.execute("USE fyp");
			testTeacher.execute("USE fyp");
			subjectSelect.execute("USE fyp");
			
			
			ResultSet classRooms, teachers, subjectsDb,subjectsDb2, specificSubjects, testTeachers, classes, teachers2, testTeachers1, testClassrooms, courseSubjects, newClasses;
			classRooms = stt.executeQuery("SELECT * FROM classroom");
			teachers = teacherStatement.executeQuery("SELECT * FROM teacher");
			subjectsDb = subjectStatement.executeQuery("SELECT * FROM subject");
			classes = classStatement.executeQuery("SELECT * FROM class");
			teachers2 = teacherStatement2.executeQuery("SELECT * FROM teacher");
			newClasses = stt2.executeQuery("SELECT * FROM class");
			subjectsDb2 = subjectSelect.executeQuery("SELECT * FROM subject");
			
			// have a select all from subjects where tid = teachers.getString("id");
			// has to be split by a '/'
			
			
			while(classRooms.next()){
				classroom.add(new ClassRoom(classRooms.getString("RoomName"), classRooms.getString("TotalStudents"), classRooms.getString("StudGroup")));
			}

			PrintWriter pw = new PrintWriter("teacherSubjects.csv");
			while(teachers.next()){
				testTeachers = testTeacher.executeQuery("SELECT * from subject  where teacherId=" + teachers.getString("id") );
				
				ArrayList<String> teacherSubjects = new ArrayList<>();
				
				while(testTeachers.next()){
					String test = testTeachers.getString("name") ;
					teacherSubjects.add(test + "/");
					
				}
			
				String formatted = teacherSubjects.toString().replace("[", "").replace("]", "")
						.replace(" ", "").replace(",", "");
				pw.println(formatted);
	
			
				
			}
			pw.flush();
			pw.close();
			
			
			String readTeacherSubjects = "teacherSubjects.csv";
			BufferedReader buffReaderTeacherSub = null;
			String line = "";
			File file = new File(readTeacherSubjects);
			ArrayList<String> lines = new ArrayList<>();
		
				
				try {
					
					buffReaderTeacherSub = new BufferedReader(new FileReader(readTeacherSubjects));
					//Scanner sc = new Scanner(file);
					//sc.hasNextLine()
					while ((line = buffReaderTeacherSub.readLine()) != null ) {
						//if (!("".equals(line))){
							lines.add(line);
						//}
						
					}
					ListIterator<String> teacherSubjectsItr = lines.listIterator();
					
					while ( teachers2.next()) {
						professors.add(new Professor(teachers2.getString("id"), teachers2.getString("t_name"),
								teacherSubjectsItr.next() ));						
					}
					
					
				}catch (Exception e) {
					e.printStackTrace();
					
				}
				finally {
					buffReaderTeacherSub.close();
				}// end try and catch

			
			// add subjects from database
			while(subjectsDb.next()){
				subjects.add(new Subject(subjectsDb.getInt("id"), subjectsDb.getString("name"), subjectsDb.getInt("no_hours"), subjectsDb.getString("level")));
			}
			
			ArrayList<Subject> classSubjects = new ArrayList();
			while(classes.next()){
				/*courseSubjects = stt.executeQuery("SELECT * from subject where class_name='" + classes.getString("classGroup") + "'" );
				 
				while(courseSubjects.next()){
				
					classSubjects.add(new Subject(courseSubjects.getInt("id"), courseSubjects.getString("name"), courseSubjects.getInt("no_hours"), courseSubjects.getString("class_name")));
					
				}*/
				
				course.add(new Course(classes.getInt("class_id"), classes.getString("classGroup"), subjects));
				//course.add(new Course(classes.getInt("class_id"), classes.getString("year"), classSubjects));
				
				
				//classSubjects.clear();
			}
			
			Iterator<Course> courseIterator =  course.iterator();
			
			while(courseIterator.hasNext()){
				// iterating through the courses
				Course test = courseIterator.next();
				
				//courseSubjects = stt3.executeQuery("SELECT * from subject where class_name='" + newClasses.getString("classGroup") + "'" );
				System.out.println("testing123");
				
				
				while(subjectsDb2.next()){
				
					test.createCombination(
							subjectsDb2.getString("name") + "/",
						20);

				}
				
				test.createStudentGroups();
				ArrayList<StudentGroups> studentGroups = test.getStudentGroups();
				timetb1.addStudentGroups(studentGroups);
								
			}
			con.close();
		} catch (Exception e) {
			e.printStackTrace();
			
		}
		
		
		createLectures(professors);
		// clearing the subjects arraylist
		subjects.clear();
		// calling the initializeTimeTable function in the timetable class
		timetb1.initializeTimeTable();
		// add timetable
		timetables.add(timetb1);
		// populate timetable
		populateTimeTable(timetb1);
		// call genetic algorithm class
		GeneticAlgorithm ge = new GeneticAlgorithm();
		// arraylist of timetable from populateTimeTable function
		ge.populationAccepter(timetables);
		System.out.println("testing 123");

	}
	// this function populates the timetables, it passes through the timetable that was made earlier
	public void populateTimeTable(TimeTable timetb1) {
		int i = 0;
		//System.out.println("populating started.......");
		// creating the number of timetables
		while (i < 3) {
			TimeTable tempTimetable = timetb1;
			// getting the room of the timetable and storing it in all rooms arraylist
			ArrayList<ClassRoom> allrooms = tempTimetable.getRoom();
			// create an interator for all room arraylist
			Iterator<ClassRoom> allroomsIterator = allrooms.iterator();
			// while all rooms have next 
			while (allroomsIterator.hasNext()) {
				// assign a room to the next room in the iterator
				ClassRoom room = allroomsIterator.next();
				// create an arraylist of week days
				ArrayList<Day> weekdays = room.getWeek().getWeekDays();
				// shuffle the weekdays
				Collections.shuffle(weekdays);
				// make an iterator for the days
				Iterator<Day> daysIterator = weekdays.iterator();
				// while the day iterator has a value
				while (daysIterator.hasNext()) {
					// assign the day to the next day in the iterator
					Day day = daysIterator.next();
					Collections.shuffle(day.getTimeSlot());
				}

			}
			// add the timetable to the arraylist of timetables
			timetables.add(tempTimetable);
			// increment the loop
			i++;
		}

	}

	// creating the lectures
	private void createLectures(ArrayList<Professor> professors) {
		// TODO Auto-generated method stub
		java.util.Iterator<Professor> professorIterator = professors.iterator();
		// while the professor has a next value
		while (professorIterator.hasNext()) {
			// getting the next professor in the arraylist
			Professor professor = professorIterator.next();
			// getting the subjects taught by the professor
			ArrayList<String> subjectsTaught = professor.getSubjectTaught();
			// making an iterator for the subjects
			Iterator<String> subjectIterator = subjectsTaught.iterator();
			while (subjectIterator.hasNext()) {
				String subject = subjectIterator.next();
				// adding to the classes arraylist passing through the profssor and the subjects taught
				classes.add(new Lecture(professor, subject));
			}
		}
	}

}
