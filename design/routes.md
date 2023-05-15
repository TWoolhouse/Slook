# Text Chat System

A interval-polling API using JSON for all body requests and responses. A cookie with the user's uid is required for all routes for verification.

- **GET** `/chat/` -> All chats.
  - **->** Thread{ uid, name }[]
- **POST** `/chat/create` -> Create a new chat with other users.
  - `name`: string _Name of the chat._
  - `with`: User[uid][] _This does not include the owner, it is implicitly the API caller._
  - **->** Thread{ uid }
- **GET** `/chat/:uid/` -> General chat info.
  - `:uid`: Thread[uid]
  - **->** Thread &
    - users: User[]
- **GET** `/chat/:uid/message/?[limit=$limit]&[cursor=$cursor]&[fwd]` -> Get the `$limit` most recent messages from the chat. If given a cursor, the messages will be the `$limit` messages before the `$cursor` message.
  - `:uid`: Thread[uid]
  - `[$limit]`: number _Number of messages to return_
  - `[$cursor]`: Message[uid]
  - `[fwd]`: boolean _If present, get all of the messages after the `$cursor` message._
  - **->** Message{ !thread }[]
- **POST** `/chat/:uid/message` -> Create a new message in the chat.
  - `:uid`: Thread[uid]
  - `msg`: string
  - **->** Message{ uid }
- **POST** `/chat/:uid/invite` -> Add someone to a chat.
  - `:uid`: Thread[uid]
  - `others`: User[uid][]
  - **->** User[uid][] _The users which have been added._

# Data Analysis System

- **GET** `/data/:email` -> Retrieves all user details
  - `[$email]` : string _Email of the user._
  - **->** User{ uid, email, name }

- **GET** `/data/:uid/tasks?` -> The currently assigned tasks for a user.
  - `:uid` : User[uid]
  - `[]

- **GET** `/data/:uid/count/tasks?[projects&[img]]&[tasks]` -> Retrieves number of tasks assigned for that user
  - `:uid` : User[uid]
  - `[projects]` : boolean _If set, return amount of tasks from each project as well. Defaults to false._
  - `[tasks]` : boolean _If set, return tasks assigned as well. Defaults to false._
  - **->** { count: number, projects?: Project[] & {count: number}, tasks?: Task[] }

- **GET** `/data/:uid/count/hours?[projects&[img]]&[tasks]` -> Retrieves the currently assigned hours for the user
  - `:uid` : User[uid]
  - `[projects]` : boolean _If set, return amount of hours from each project as well. Defaults to false._
  - `[tasks]` : boolean _If set, return tasks assigned as well. Defaults to false._
  - **->** { hours: number, projects?: Project[] & {hours: number}, tasks?: Task[] }

- **GET** `/data/:uid/leading?[projects]` -> Retrieves the number of projects led by that user
  - `:uid` : User[uid]
  - `[projects]` : boolean _If set, return the project as well. Defaults to false._
  - **->** { leading: number, projects?: Project[] }

- **GET** `/data/:uid/productivity?[timespan=$timespan]` -> Retrieves the average tasks completed per day within `$timespan`
  - `:uid` : User[uid]
  - `[$timespan]` : integer _- Measured in days. If not specified, defaults to 7._
  - **->** { completed: number, efficiency: number }

- **GET** `/data/:task/eta?[users]` -> Retrieves the estimated number of hours to complete the task
  - `:task` : Task[uid]
  - `[users]` : boolean _If set, return the users assigned._
  - **->** { raw: number, hours: number, users?: User[] }
