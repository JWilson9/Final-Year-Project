package dynamicTT;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Iterator;
import java.util.Stack;

public class TimeTable {
	private ArrayList<ClassRoom> rooms = new ArrayList<ClassRoom>();
	private int fittness;
	private ArrayList<Lecture> classes = new ArrayList<>();
	private ArrayList<StudentGroups> studentGroups = new ArrayList<>();
	private ArrayList<ClassRoom> classRooms = new ArrayList<ClassRoom>();
	private ArrayList<StudentGroups> allStudentGroups = new ArrayList<>();

	public TimeTable(ArrayList<ClassRoom> classroom, ArrayList<Lecture> lectures) {
		this.rooms = classroom;
		this.classes = lectures;
		this.fittness = 999;
	}

	public int getFittness() {
		return fittness;
	}

	public void setFittness(int fittness) {
		this.fittness = fittness;
	}

	public void addStudentGroups(ArrayList<StudentGroups> studentgrps) {
		// TODO Auto-generated method stub
		studentGroups.addAll(studentgrps);
	}
	// function to init the timetable
	public void initializeTimeTable() {
		// looping through until the iterator is empty
		for (Iterator<ClassRoom> roomsIterator = rooms.iterator(); roomsIterator
				.hasNext();) {
			// assign the room to the next room in the iterator
			ClassRoom room = roomsIterator.next();
			// add to arraylist classrooms
			classRooms.add(room);

		}
		for (Iterator<StudentGroups> studentGroupIterator = studentGroups
				.iterator(); studentGroupIterator.hasNext();) {
			StudentGroups studentGroup = studentGroupIterator.next();
			allStudentGroups.add(studentGroup);
		}
		// clearing the rooms iterator
		rooms.clear();
		// calling function set timetable with student groups & all classrooms
		setTimeTable(allStudentGroups, classRooms);
		// add all of the classrooms to the rooms iterator
		rooms.addAll(classRooms);
	}
	
	public void setTimeTable(ArrayList<StudentGroups> studentGroups2,
			ArrayList<ClassRoom> rooms2) {
		// TODO Auto-generated method stub
		Collections.shuffle(studentGroups2);
		// creating a stack for the lecture
		Stack<Lecture> lecturesStack = new Stack<Lecture>();
		// for loop that iterates through the student groups, until the sdtGrpIterator has next 
		for (Iterator<StudentGroups> sdtGrpIterator = studentGroups2.iterator(); sdtGrpIterator
				.hasNext();) {
			// getting the next student group in the iterator e.g. 5A
			StudentGroups studentGrp = sdtGrpIterator.next();
			// Getting the subject name that the student group has
			String subject = studentGrp.getSubjectName();
			// getting the number of lecture classes per week for each student group
			int noOfLectures = studentGrp.getNoOfLecturePerWeek();
			//iterating through the number of lecture classes i.e. 30 hours per week
			for (int i = 0; i < noOfLectures; i++) {
				// shuffling the lecture classes so they are not in order
				Collections.shuffle(classes);
				// iterator for the class lecture
				Iterator<Lecture> classIterator = classes.iterator();
				// while the iterator has a value
				while (classIterator.hasNext()) {
					// assign the lecture to be the next lecture in the iterator
					Lecture lecture = classIterator.next();
					// if the lectures subject is equal to the string subject from studentGrp.getSubjectName() above 
					if (lecture.getSubject().equalsIgnoreCase(subject)) {
						// this is creating a lecture with the professor and the subject with the student group
						Lecture mainLecture = new Lecture(
								lecture.getProfessor(), lecture.getSubject());
						mainLecture.setStudentGroup(studentGrp);
						lecturesStack.push(mainLecture);
						break;
					}
				}
			}
		}
		// while the lecturestack is not empty 
		while (!(lecturesStack.empty())) {
			// shuffling function to shuffle the lecture stack
			Collections.shuffle(lecturesStack);
			// assign lecture2 to the lecturestack (the lecture that is at the top of the push and pop)
			Lecture lecture2 = lecturesStack.pop();
			// calling the function place lecture, the with the lecture abnd the rooms
			placeTheoryLecture(lecture2, rooms2);
		}
	}

	// passing through the lecture (pro name, sub name, stud group) and the rooms
	private void placeTheoryLecture(Lecture lecture, ArrayList<ClassRoom> rooms2) {
		// TODO Auto-generated method stub
		// getting the size of the class 
		int size = lecture.getStudentGroup().getSize();
		// getting the dept whether it is a higher or ordinary class
		String dept = lecture.getStudentGroup().getDepartment();
		// init boolean to be true
		boolean invalid = true;
		// init classroom object to be null
		ClassRoom room = null;
		// shuffle the rooms (arraylist)
		Collections.shuffle(rooms2);
		// while true
		while (invalid) {
			// assigning the best room suitable for the room variable 
			room = getBestRoom(size, rooms2);
			// If the rooms are the same i.e. ord = ord then return false
			// and shuffle the rooms, it will get out of the while loop
			if (room.getDepartment().equalsIgnoreCase(dept)) {
				invalid = false;
				Collections.shuffle(rooms2);
			} else {
				// shuffles room but stays in the while loop until dept = dept
				Collections.shuffle(rooms2);
			}
		}
		
		// Getting the weekdays and storing in the object arraylist day
		ArrayList<Day> weekdays = room.getWeek().getWeekDays();
		// init an iterator for the days of the week 
		Iterator<Day> daysIterator = weekdays.iterator();
		// while the days of the week has next
		while (daysIterator.hasNext()) {
			// get the next day 
			Day day = daysIterator.next();
			ArrayList<TimeSlot> timeslots = day.getTimeSlot();
			Iterator<TimeSlot> timeslotIterator = timeslots.iterator();
			while (timeslotIterator.hasNext()) {
				TimeSlot lecture2 = timeslotIterator.next();
				// if the timeslot is free add the lecture to this timeslot
				if (lecture2.getLecture() == null) {
					lecture2.setLecture(lecture);
					return;
				}
			}
		}
	}

	// checking if the room is occupied (returning boolean)
	private boolean checkOccupiedRoom(ClassRoom tempRoom,
			ArrayList<ClassRoom> rooms2) {
		// TODO Auto-generated method stub
		// excute the for loop when the room iterators have next
		for (Iterator<ClassRoom> roomsIterator = rooms2.iterator(); roomsIterator
				.hasNext();) {
			// get the next room from the iterator
			ClassRoom room = roomsIterator.next();
			// if the rooms are the same execute the if statement
			if (room.equals(tempRoom)) {
				// getting the weekdays and storing them in an arraylist
				ArrayList<Day> weekdays = room.getWeek().getWeekDays();
				// making an iterator for the weekdays
				Iterator<Day> daysIterator = weekdays.iterator();
				
				while (daysIterator.hasNext()) {
					// getting the next day in the iterator
					Day day = daysIterator.next();
					// getting the time slots for the day
					ArrayList<TimeSlot> timeslots = day.getTimeSlot();
					// making an iterator for the time slots 
					Iterator<TimeSlot> timeslotIterator = timeslots.iterator();
					// while the time slot has a next time slot
					while (timeslotIterator.hasNext()) {
						// Getting the lecture of that time slot
						TimeSlot lecture = timeslotIterator.next();
						// if the time slot is empty then return false
						if (lecture.getLecture() == null) {
							// program now knows that the time slot is free for the room
							return false;
						}
					}
				}
				return true;
			}
		}
		return false;
	}

	private ClassRoom getBestRoom(int size, ArrayList<ClassRoom> rooms2) {
		// TODO Auto-generated method stub
		int num = 1000;
		ClassRoom room = null;
		for (Iterator<ClassRoom> roomsIterator = rooms2.iterator(); roomsIterator
				.hasNext();) {
			ClassRoom tempRoom = roomsIterator.next();
			if (!checkOccupiedRoom(tempRoom, rooms2)) {
				
				int temp = Math.abs(size - tempRoom.getSize().length());
				if (temp < num) {
					num = temp;
					room = tempRoom;
				}
			}
		}
		return room;
	}

	public ArrayList<ClassRoom> getRoom() {
		return rooms;
	}

	public void setRoom(ArrayList<ClassRoom> room) {
		this.rooms = room;
	}

	public ArrayList<ClassRoom> getclassRooms() {
		return classRooms;
	}

	public void setclassRooms(ArrayList<ClassRoom> classRooms) {
		classRooms = classRooms;
	}

	public ArrayList<StudentGroups> getallStudentGroups() {
		return allStudentGroups;
	}

	public void setallStudentGroups(
			ArrayList<StudentGroups> allStudentGroups) {
		this.allStudentGroups = allStudentGroups;
	}

}