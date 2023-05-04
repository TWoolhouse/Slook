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

const MEMBER_LIST = [];

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
		MEMBER_LIST.length = 0;
		for (const user of r.users) {
			MEMBER_LIST.push(user);
			const ui_user = HTMLasDOM(HTML_member(user));
			ui_users.appendChild(ui_user);
		}
	}

	{
		const ui_title = document.getElementById("thread_name");
		ui_title.innerHTML = r.name;
	}

	{
		const ui_chats = document.getElementById("chatbox");

		let r = await (await fetch(`/chat/${uid}/message?limit=20`)).json();
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
			ui_chat.scrollIntoView({
				behavior: "auto"
			})
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
	let owner = MEMBER_LIST.find(u => u.uid === msg.owner);
	let date = new Date(msg.created).toLocaleDateString(undefined, {
		dateStyle: "short",
	})
	let time = new Date(msg.created).toLocaleTimeString(undefined, {
		timeStyle: "short"
	})
	return /* HTML */ `
	<div id="m${msg.uid}" class="msg">
		<img class="pfp" src="${avatar(owner, 32)}" width="32" height="32">
		<div>
			<span>${owner.name ?? owner.email}</span>
			<span>${time} ${date}</span>
			<span>${msg.uid}</span>
		</div>
		<span class="c" >${msg.content}</span>
	</div>
	`;
}

function avatar(user, size = 32) {
	const name = encodeURIComponent(user.name ?? user.email ?? "User");
	return `https://ui-avatars.com/api/?name=${name}&background=random&size=${size}&format=svg"`;
}

function HTML_member(user) {
	const name = encodeURIComponent(user.name ?? user.email ?? "User");
	return /* HTML */ `
	<div class="member">
		<img src="${avatar(user, 32)}" width="32" height="32">
		<span>${user.email}</span>
	</div>
	`;
}

threads();
sender();
