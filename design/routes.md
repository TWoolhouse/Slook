# Text Chat System

A interval-polling API using JSON for all body requests and responses. A cookie with the user's uid is required for all routes for verification.

- **GET** `/chat/` -> All chats.
  - **->** Thread{ uid, name }[]
- **POST** `/chat/create` -> Create a new chat with other users.
  - `name`: string *- Name of the chat.*
  - `with`: User[uid][] *- This does not include the owner, it is implicitly the API caller.*
  - **->** Thread{ uid }
- **GET** `/chat/:uid/` -> General chat info.
  - `:uid`: Thread[uid]
  - **->** Thread &
    - users: User[]
- **GET** `/chat/:uid/message/?[limit=$limit]&[cursor=$cursor]&[fwd]` -> Get the `$limit` most recent messages from the chat. If given a cursor, the messages will be the `$limit` messages before the `$cursor` message.
  - `:uid`: Thread[uid]
  - `[$limit]`: number *- Number of messages to return*
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
  - **->** User[uid][] *- The users which have been added.*
