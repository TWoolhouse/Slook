const _wrapper = document.createElement("div");
/**
 * Converts the HTML into a DOM Node
 * @param {String} html The HTML String
 * @returns {Element} An Element
 */
function HTMLasDOM(html) {
	_wrapper.innerHTML = html.trim();
	const element = _wrapper.firstChild;
	element.remove();
	return element;
}

let THREAD = 0;
let CURSOR = 0;
let LOOP_HANDLE = null;
const LOOP_TIMEOUT = 1000;

/**
 * Loads the current threads of the user
 */
async function threads() {
	let r = await (await fetch("/chat")).json();
	const ui_threads = document.getElementById("select_thread");
	const empty = ui_threads.firstChild;
	ui_threads.children.length = 0;
	if (!empty.value)
		ui_threads.appendChild(empty);
	for (const thread of r) {
		const ui_option = HTMLasDOM(/* HTML */ `<option value="${thread.uid}">${thread.name}</option>`);
		ui_threads.appendChild(ui_option);
		ui_threads.addEventListener("change", () => {
			const empty = ui_threads.firstChild;
			if (!empty.value) empty.remove();
			thread_load(thread.uid)
		})
	}
}

/**
 * Loads a new thread into the document
 * @param {number} uid
 */
async function thread_load(uid) {
	const ui_send_button = document.getElementById("btn_send");
	ui_send_button.setAttribute("disabled", null);
	clearTimeout(LOOP_HANDLE)

	let r = await (await fetch(`/chat/${uid}`)).json();
	THREAD = r.uid;

	{
		const ui_users = document.getElementById("thread_members");
		ui_users.innerHTML = null;
		for (const user of r.users) {
			const ui_user = HTMLasDOM(/* HTML */ `<span>${user.email}</span>`);
			ui_users.appendChild(ui_user);
		}
	}

	{
		const ui_title = document.getElementById("thread_name");
		ui_title.innerHTML = r.name;
	}

	{
		const ui_chats = document.getElementById("chatbox");

		let r = await (await fetch(`/chat/${uid}/message?limit=35`)).json();
		console.log(r);
		ui_chats.innerHTML = null;
		for (const msg of r) {
			const ui_chat = HTMLasDOM(HTML_chat(msg));
			ui_chats.append(ui_chat);
		}
		CURSOR = r[0].uid;
	}

	ui_send_button.removeAttribute("disabled");
	receiver();
}

async function receiver() {
	let r = await (await fetch(`/chat/${THREAD}/message?fwd&cursor=${CURSOR}`)).json();
	if (r.length > 0) {
		const ui_chats = document.getElementById("chatbox");
		let last_msg = ui_chats.querySelector(`#m${CURSOR}`);
		if (last_msg) {
			while (last_msg.previousElementSibling != null)
				last_msg.previousElementSibling.remove()
		}


		for (const msg of r) {
			const ui_chat = HTMLasDOM(HTML_chat(msg));
			ui_chats.prepend(ui_chat);
		}
		CURSOR = r[r.length - 1].uid;
	}
	LOOP_HANDLE = setTimeout(receiver, LOOP_TIMEOUT)
}

function sender() {
	const ui_send = document.getElementById("form_send");
	const ui_msg = ui_send.querySelector("input");
	ui_send.addEventListener("submit", async (e) => {
		e.preventDefault()

		let msg = ui_msg.value;
		ui_msg.value = null;

		let r = await (await fetch(`/chat/${THREAD}/message`, {
			body: JSON.stringify({ "content": msg }),
			method: "POST",
		})).json()
		clearTimeout(LOOP_HANDLE)
		receiver()

		return false;
	})
}

function HTML_chat(msg) {
	return /* HTML */ `
	<div id="m${msg.uid}" class="msg">
		<span>${msg.uid}</span>
		<span>${msg.owner}</span>
		<span>${msg.content}</span>
	</div>
	`;
}

threads();
sender();
