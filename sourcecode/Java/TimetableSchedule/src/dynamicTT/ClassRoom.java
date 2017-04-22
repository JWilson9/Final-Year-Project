package dynamicTT;

import com.mysql.jdbc.*;

public class ClassRoom {

	// represents each classroom

	private String roomID;
	private String size;
	private Week week;
	private String department;

	public ClassRoom(String id, String string,  String dept) {
		this.roomID = id;
		this.setWeek(new Week());
		this.setSize(string);
		this.department = dept;
	}
	
	

	public String getRoomNo() {
		return roomID;
	}

	public void setRoomNo(String roomNo) {
		this.roomID = roomNo;
	}

	public Week getWeek() {
		return week;
	}

	public void setWeek(Week week) {
		this.week = week;
	}

	public String getSize() {
		return size;
	}

	public void setSize(String string) {
		this.size = string;
	}

	public String getDepartment() {
		return department;
	}

	public void setDepartment(String department) {
		this.department = department;
	}
}
