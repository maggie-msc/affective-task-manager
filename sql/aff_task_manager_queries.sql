CREATE TABLE User (
	user_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(user_id)
);

CREATE TABLE TaskList (
	list_id INT NOT NULL AUTO_INCREMENT,
    list_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (list_id)
);

INSERT INTO TaskList (list_name) VALUES ("Today");

CREATE TABLE Task (
	task_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NULL,
    due_date DATE NULL,
    start_date DATE NULL,
    priority VARCHAR(255) NULL,
    mood VARCHAR(255) NULL,
    user_id INT NOT NULL,
    shared_user INT NULL,
    time_estimate INT NULL,
    -- task_list INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(user_id),
    FOREIGN KEY (shared_user) REFERENCES User(user_id),
    -- FOREIGN KEY (task_list) REFERENCES TaskList(list_id),
    PRIMARY KEY (task_id)
);

CREATE TABLE Subtask (
	subtask_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    parent_task INT NOT NULL,
    FOREIGN KEY (parent_task) REFERENCES Task(task_id),
    PRIMARY KEY (subtask_id)
);

CREATE TABLE Mood (
	mood_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    PRIMARY KEY (mood_id)
);

CREATE TABLE CurrentMood (
	currentmood_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    date DATE NULL,
    PRIMARY KEY (currentmood_id)
);

CREATE TABLE WeeklyGoal (
	weeklygoal_id INT NOT NULL AUTO_INCREMENT,
    goal_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    PRIMARY KEY (weeklygoal_id)
);

CREATE TABLE WeeklyMoodGoal (
	moodgoal_id INT NOT NULL AUTO_INCREMENT,
    moodgoal_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    PRIMARY KEY (moodgoal_id)
);

CREATE TABLE Tag (
	tag_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (tag_id)
);

CREATE TABLE TaskTag (
	id INT NOT NULL AUTO_INCREMENT,
    task_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES Task(task_id),
    FOREIGN KEY (tag_id) REFERENCES Tag(tag_id),
    PRIMARY KEY (id)
);

CREATE TABLE TaskMood (
	taskmood_id INT NOT NULL AUTO_INCREMENT,
    task_id INT NOT NULL,
    mood_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES Task(task_id),
    FOREIGN KEY (mood_id) REFERENCES Mood(mood_id),
    PRIMARY KEY (taskmood_id)
);

CREATE TABLE TaskTag (
	tasktag_id INT NOT NULL AUTO_INCREMENT,
    task_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES Task(task_id),
    FOREIGN KEY (tag_id) REFERENCES Tag(tag_id),
    PRIMARY KEY (tasktag_id)
);

    