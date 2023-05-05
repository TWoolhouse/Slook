# Text Chat System

A interval-polling API using JSON for all body requests and responses. A cookie with the user's uid is required for all routes for verification.

- **GET** `/chat/` -> All chats.
  - **->** Thread{ uid, name }[]
- **POST** `/chat/create` -> Create a new chat with other users.
  - `name`: string _- Name of the chat._
  - `with`: User[uid][] _- This does not include the owner, it is implicitly the API caller._
  - **->** Thread{ uid }
- **GET** `/chat/:uid/` -> General chat info.
  - `:uid`: Thread[uid]
  - **->** Thread &
    - users: User[]
- **GET** `/chat/:uid/message/?[limit=$limit]&[cursor=$cursor]&[fwd]` -> Get the `$limit` most recent messages from the chat. If given a cursor, the messages will be the `$limit` messages before the `$cursor` message.
  - `:uid`: Thread[uid]
  - `[$limit]`: number _- Number of messages to return_
  - `[$cursor]`: Message[uid]
  - `[fwd]`: If forward is present, get all of the messages after the `$cursor` message.
  - **->** Message{ !thread }[]
- **POST** `/chat/:uid/message` -> Create a new message in the chat.
  - `:uid`: Thread[uid]
  - `msg`: string
  - **->** Message{ uid }
- **POST** `/chat/:uid/invite` -> Add someone to a chat.
  - `:uid`: Thread[uid]
  - `others`: User[uid][]
  - **->** User[uid][] _- The users which have been added._

# Data Analysis System

- **GET** `/data/?[email=$email]` -> Retrieves all user details

  - `[$email]` : string _- Email of the user._
  - **->** User{ uid, email, name, role }

- **GET** `/data/:uid/tasksAssigned/?[displayProjects=$displayProjects]` -> Retrieves number of tasks assigned for that user

  - `:uid` : User[uid]
  - `[$displayProjects]` : boolean _- If true, API will return amount of tasks from each project as well. Defaults to false._
  - **->** ???

- **GET** `/data/:uid/projectsLed/?[showDetails=$showDetails]` -> Retreives the number of projects led by that user

  - `:uid` : User[uid]
  - `[$showDetails]` : boolean _- If true, API will return each project details also. Defaults to false._
  - **->** ???

- **GET** `/data/:uid/productivity/?[timespan=$timespan]` -> Retreives the average tasks completed within `$timespan`

  - `:uid` : User[uid]
  - `[$timespan]` : integer _- Measured in days. If not specified, defaults to 7._
  - **->** ???

- **GET** `/data/:uid/hoursAssigned/?[displayProjects=$displayProjects]` -> Retrieves the currently assigned hours for the user

  - `:uid` : User[uid]
  - **->** ???

- **GET** `/data/estimatedCompletionTime/?[taskID=$taskID]` -> Retrieves the estimated completion time for task with `$taskID`

  - `[$taskID]` : Task[uid]
  - **->** ???
