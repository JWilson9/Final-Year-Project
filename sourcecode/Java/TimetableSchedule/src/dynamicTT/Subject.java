package dynamicTT;

import com.mysql.jdbc.*;

public class Subject {

	private int subjectID;
	private String subjectName;
	private int numberOfLecturesPerWeek;
	private String department;

	Subject(int id, String name, int lectures, String dept) {
		this.subjectID = id;
		this.subjectName = name;
		this.numberOfLecturesPerWeek = lectures;
		this.department = dept;
	}

	public String getSubjectName() {
		return subjectName;
	}

	public void setSubjectName(String subjectName) {
		this.subjectName = subjectName;
	}

	public int getNumberOfLecturesPerWeek() {
		return numberOfLecturesPerWeek;
	}

	public void setNumberOfLecturesPerWeek(int numberOfLecturesPerWeek) {
		this.numberOfLecturesPerWeek = numberOfLecturesPerWeek;
	}

	public int getSubjectID() {
		return subjectID;
	}
	
	
	/*public String getSubjectID() {
		return String.valueOf(subjectID);
	}*/

	public void setSubjectID(int subjectID) {
		this.subjectID = subjectID;
	}

	

	public String getDepartment() {
		return department;
	}

	public void setDepartment(String department) {
		this.department = department;
	}

}
