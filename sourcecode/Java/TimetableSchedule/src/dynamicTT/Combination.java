package dynamicTT;

import java.util.ArrayList;
import com.mysql.jdbc.*;

public class Combination {
	// init the size of the class
	private int sizeOfClass;
	private ArrayList<String> subjectCombination=new ArrayList<>();

	public Combination(String subjects, int size) {
		// TODO Auto-generated constructor stub
		
		// setting the size of the class
		setSizeOfClass(size);		
		// splitting the subjuct up by the '/' after each combo in the initialization file
		String[] subj = subjects.split("/");
		for(int i=0; i<subj.length;i++){
			subjectCombination.add(subj[i]);
		}
	}

	public int getSizeOfClass() {
		return sizeOfClass;
	}

	public void setSizeOfClass(int sizeOfClass) {
		this.sizeOfClass = sizeOfClass;
	}

	public ArrayList<String> getSubjects() {
		return subjectCombination;
	}

	public void setSubjects(ArrayList<String> subjects) {
		this.subjectCombination = subjects;
	}
}
