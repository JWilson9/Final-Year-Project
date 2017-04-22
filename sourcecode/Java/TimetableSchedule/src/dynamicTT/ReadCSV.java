package dynamicTT;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.ListIterator;

public class ReadCSV {

	ArrayList<String> attributes = new ArrayList<>();
	ArrayList<String> TeacherAtt = new ArrayList<>();
	ArrayList<String> subjectAtt = new ArrayList<>();
	ArrayList<ClassRoom> classroom = new ArrayList<>();

	public void readFile() throws IOException {
		// Input file which needs to be parsed
		String readClassRoom = "classRoom.csv";
		String readTeachers = "teacher.csv";
		String readSubjects = "subjects.csv";

		// reading in the files
		BufferedReader fileReader = null;
		BufferedReader fileTeacher = null;
		BufferedReader fileSubject = null;

		ArrayList<String> lines = new ArrayList<>();
		// Delimiter used in CSV file
		final String DELIMITER = ",";
		String line = "";

		try {
			// create file readers using the bufferedReader function in Java 
			fileReader = new BufferedReader(new FileReader(readClassRoom));
			fileTeacher = new BufferedReader(new FileReader(readTeachers));
			fileSubject = new BufferedReader(new FileReader(readSubjects));
			while ((line = fileReader.readLine()) != null) {
				// Get all tokens available in line
				String[] tokens = line.split(DELIMITER);
				lines.add(line);
				for (String token : tokens) {
					// adding the attributes with the value token on the specific line in the CSV file
					attributes.add(token);
				}
			}
			// reading in line by line of the teachers files
			while ((line = fileTeacher.readLine()) != null) {
				// Get all tokens available in line
				String[] tokens = line.split(DELIMITER);
				lines.add(line);
				for (String token : tokens) {
					TeacherAtt.add(token);
				}
			}
			// reading in line by line of the teachers files
			while ((line = fileSubject.readLine()) != null) {
				// Get all tokens available in line
				String[] tokens = line.split(DELIMITER);
				lines.add(line);
				int i = 0;
				for (String token : tokens) {
					subjectAtt.add(token);
					// testing[i] = token;
					i++;
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try {
				// closing all of the files 
				fileReader.close();
				fileTeacher.close();
				fileSubject.close();
			
			} catch (IOException e) {
				// print out error if files don't close properly
				e.printStackTrace();
			}
		}// end try and catch

		
		// creating an list iterator for the attributes in the CSV files
		ListIterator<String> litr = attributes.listIterator();
		ListIterator<String> pItr = TeacherAtt.listIterator();
		ListIterator<String> subItr = subjectAtt.listIterator();
				
		
		// this is all commented out, it is just an example of how to read and add from a CSV file
		/*while (litr.hasNext()) {
			classroom.add(new ClassRoom(litr.next(), litr.next(), litr.next()));
		    }*/
		
		/*while(pItr.hasNext()){
			professors.add(new Professor(pItr.next(), pItr.next(), pItr.next()));
			//System.out.print(pItr.next() + " ");
		}*/
		//ArrayList<String> SubjectName = new ArrayList<String>();
		//while(subItr.hasNext()){
			// int, string, int, string
			//subjects.add(new Subject(subItr.nextIndex(), subItr.next(), subItr.nextIndex(), subItr.next() ));
			
			
			
			/*subItr.next();
			SubjectName.add(subItr.next());
			subItr.next();
			subItr.next();*/
			
		//}
	}// end public function readFile 

}