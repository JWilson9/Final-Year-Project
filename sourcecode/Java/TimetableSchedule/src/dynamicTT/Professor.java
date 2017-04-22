package dynamicTT;

import java.util.ArrayList;
import com.mysql.jdbc.*;

public class Professor {
	private String professorID;
	private String professorName;
	private ArrayList<String> subjectsTaught = new ArrayList();

	Professor(String string, String name, String subj) {
		this.professorID = string;
		this.professorName = name;
		String[] subjectNames = subj.split("/");
		for (int i = 0; i < subjectNames.length; i++) {
			//if (subjectNames != null) {
				this.subjectsTaught.add(subjectNames[i]);
			//}
		}
	}

	/*
	 * Professor(String string, String name, ArrayList <String>
	 * subjectsTaught1){ this.professorID=string; this.professorName=name;
	 * this.subjectsTaught.addAll(subjectsTaught1);
	 * 
	 * }
	 */

	public String getProfessorID() {
		return professorID;
	}

	public void setProfessorID(String professorID) {
		this.professorID = professorID;
	}

	public String getProfessorName() {
		return professorName;
	}

	public void setProfessorName(String professorName) {
		this.professorName = professorName;
	}

	public ArrayList<String> getSubjectTaught() {
		return subjectsTaught;
	}

	public void setSubjectTaught(ArrayList<String> subjectTaught) {
		this.subjectsTaught = subjectTaught;
	}

}
