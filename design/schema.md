```mermaid
erDiagram

	Thread ||--|{ ThreadMessage : message
	Message ||--|{ ThreadMessage : thread

	User ||--|{ Message : owner
	User ||--|{ ThreadViewer : viewer
	Thread ||--|{ ThreadViewer : participant

	User {
		string uid
		string email
		string name
		string password
		number role
	}

	Thread {
		string uid
		string name
	}

	Message {
		number uid
		Thread thread
		User owner
		string content
		datetime created
	}

	ThreadMessage {
		Thread thread
		Message message
	}

	ThreadViewer {
		Thread thread
		User viewer
	}

```
