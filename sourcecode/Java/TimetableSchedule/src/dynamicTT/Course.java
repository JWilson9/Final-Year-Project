package dynamicTT;

import java.util.ArrayList;
import java.util.Iterator;
import com.mysql.jdbc.*;

public class Course {

	// represents each course
	// course id
	private int courseID;
	// init the course name
	private String courseName;
	// creating an array list of all the subjects
	private ArrayList<Subject> subjectsIncluded = new ArrayList<Subject>();
	// creating combinations for the subjects
	private ArrayList<Combination> combinations = new ArrayList<Combination>();

	public ArrayList<Combination> getCombinations() {
		return combinations;
	}

	public void setCombinations(ArrayList<Combination> combinations) {
		this.combinations = combinations;
	}

	private ArrayList<StudentGroups> studentGroups = new ArrayList<StudentGroups>();

	public ArrayList<StudentGroups> getStudentGroups() {
		return studentGroups;
	}

	public void setStudentGroups(ArrayList<StudentGroups> studentGroups) {
		this.studentGroups = studentGroups;
	}

	// creating a new course, with the id, course name, list of subjects
	Course(int id, String name, ArrayList<Subject> subjects) {
		System.out.println("creating new course.......");
		this.courseID = id;
		this.courseName = name;
		this.subjectsIncluded = subjects;
	}

	// creating the student groups
	public void createStudentGroups() {
		int size = 0;
		ArrayList<Combination> combs = new ArrayList<Combination>();
		Iterator<Subject> subjectIterator = subjectsIncluded.iterator();
		// the subject iterator has next
		while (subjectIterator.hasNext()) {
			// getting the next subject in the iterator
			Subject subject = subjectIterator.next();
			Iterator combIterator = combinations.iterator();
			while (combIterator.hasNext()) {
				Combination combination = (Combination) combIterator.next();
				ArrayList<String> subjects = combination.getSubjects();
				Iterator<String> subjectItr = subjects.iterator();
				while (subjectItr.hasNext()) {
					if (subjectItr.next().equalsIgnoreCase(
							subject.getSubjectName())) {
						size = size + combination.getSizeOfClass();
						if (!combs.contains(combination.getSubjects())) {
							combs.add(combination);
						}
					}
				}
			}
			StudentGroups studentGroup = new StudentGroups(this.courseName
					+ "/" + subject.getSubjectName(),
					subject.getNumberOfLecturesPerWeek(), size, combs,
					subject.getSubjectName(), 
					subject.getDepartment());
			// studentGroups.add(studentGroup);
			studentGroups.add(studentGroup);
			size = 0;
		}
	}

	// creates all possible professor x subject he teaches combinations and
	// saves as lecture objects

	public void createCombination(String subjects, int size) {
		Combination combination = new Combination(subjects, size);
		combinations.add(combination);
	}

	public int getCourseID() {
		return courseID;
	}

	public void setCourseID(int courseID) {
		this.courseID = courseID;
	}

	public String getCourseName() {
		return courseName;
	}

	public void setCourseName(String courseName) {
		this.courseName = courseName;
	}

	public ArrayList<Subject> getSubjectsTaught() {
		return subjectsIncluded;
	}

	public void setSubjectsTaught(ArrayList<Subject> subjectsTaught) {
		this.subjectsIncluded = subjectsTaught;
	}

}
