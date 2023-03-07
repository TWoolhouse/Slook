```mermaid
erDiagram

	Message }|--|| Thread : message

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

	ThreadViewer {
		Thread thread
		User viewer
	}

```
