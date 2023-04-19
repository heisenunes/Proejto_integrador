# Graph Implementations

## General Graphs

### Daily Login Counts

For this graph, we created a new table in the database called `user_login_counts` where we store the:
- `day`;
- `count`, the amount of logins of that day.

To populate the table, inside the `LoginController::login` function, we created a condition to see if the row for that day already exists, and if it does, increment the `count` by one. If the entrance for that day doesn't already exist, we create it and set the `count` to 1.

## User Graphs

### Average Session Duration

For this graph, we created two tabes in the database, `user_session_durations` and `average_session_durations`. Inside `user_session_durations`, we store the:
- `session_id`;
- `user_id`;
- `first_request_time`;
- `last_request_time`;
- `session_duration`.

Inside `average_session_durations`, we store the:
- `day`;
- `average_duration`;
- `session_count`.

The way we store values inside the `user_session_durations` is by creating a Laravel Middleware which we called `UserSessionDuration.php` which is called every single time a new link is clicked by a user. If there is no entrance for that `session_id`, we create a new one, setting the values as:
- `session_id` = session id;
- `user_id` = user id;
- `first_request_time` = current time;
- `last_request_time` = current time;
- `session_duration` = 0.

If the `session_id` entrance already exists, we update the `session_duration` and `last_request_time` to it's new respective values.

In this case, there is a flow between the two tables. We start by populating the `user_session_durations` table with all the user sessions, which we then check for abnormal values (such as too short/long session durations) and add the values to the `average_session_durations`, removing them from the first table.

## Topic Graphs

### Total Topics Finished

For this graph, we use a table called `finished_topics` where we store the values:
- `topic_id`;
- `user_id`.

To create the data for the graph, we search for all the rows with the same `topic_id` and then add them together.

### Topic Visits

For this graph, we use a table called `topic_visits` which stores the values:
- `topic_id`;
- `day`;
- `count`.

To stores values for this table, inside the function `TopicController::show`, we create a conditional statement to check for an entrance for a certain day, and it if already exists, we increment the `count` by 1. If the entrance does not exist, we create it and set the `count` to 1.

## Question Graphs

### Right vs Wrong Answers

For this graph, we set two attributes inside the `questions` table which are:
- `correct_answers`;
- `incorrect_answers`.

Every time a user get a question right or wrong, we update this value. We then simple use those values to create the coordinates to be used in the graph.

### Average Time per Question

For this graph, we created a new table called `question_durations` where we store the values:
- `user_id`;
- `question_id`;
- `first_request_time`;
- `duration`.

When a user enters a question, a new entrance in the table is created. When the user correctly answers that questions and moves on to the next page, the `duration` attribute is calculated and stored, which we will then use to display on the graph.
