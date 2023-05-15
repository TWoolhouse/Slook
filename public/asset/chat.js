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
	for (let thread of r) {
		let ui_option = HTMLasDOM(/* HTML */ `<option value="${thread.uid}">${thread.name}</option>`);
		ui_threads.appendChild(ui_option);
		ui_threads.addEventListener("change", () => {
			const empty = ui_threads.firstChild;
			if (!empty.value) empty.remove();
			if (ui_threads.value == thread.uid)
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
	const ui_buttons = [ui_send_button, document.getElementById("thread_add_dialog")]
	for (const ui_btn of ui_buttons)
		ui_btn.setAttribute("disabled", null);
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
		ui_chats.innerHTML = "";
		for (const msg of r) {
			const ui_chat = HTMLasDOM(HTML_chat(msg));
			ui_chats.append(ui_chat);
		}
		CURSOR = r.length > 0 ? r[0].uid : 0;
	}

	for (const ui_btn of ui_buttons)
		ui_btn.removeAttribute("disabled");
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

function instansiate_dialog() {
	ui_body = document.querySelector("body")
	for (const dialog of [dialog_create(), dialog_add()]) {
		dialog.querySelector(".head button").addEventListener("click", () => {
			dialog.close()
		})
		ui_body.appendChild(dialog)
	}
}

function dialog_create() {
	let dialog = HTMLasDOM(HTML_dialog_create())

	let user_list = []
	let ui_picker = dialog.querySelector(".picker")
	let ui_select = ui_picker.querySelector("select")
	let ui_form = dialog.querySelector("form.submit")
	let ui_selected = ui_form.querySelector(".selected")

	document.getElementById("thread_create_dialog").addEventListener("click", () => {
		dialog.showModal()
		for (const opt of ui_select.querySelectorAll("option")) {
			opt.classList.remove("hidden")
		}
		ui_selected.children.length = 0;
		ui_form.reset()
	})

	ui_picker.querySelector("button").addEventListener("click", event => {
		let user_uid = ui_select.value
		ui_select.value = ""
		user_list.push(user_uid)
		for (const opt of ui_select.querySelectorAll("option")) {
			if (opt.value == user_uid) {
				opt.classList.add("hidden")
				break
			}
		}
		ui_selected.appendChild(HTMLasDOM(HTML_member(USERS.find(u => u.uid == user_uid))))
	})

	ui_form.addEventListener("submit", event => {
		dialog.close();
		event.preventDefault()
		let uuids = [...user_list.map(uid => +uid)]
		let name = ui_form.querySelector("input").value
		user_list.length = 0;
		(async () => {
			console.log(name, uuids);
			await fetch("/chat/create", {
				method: "POST",
				body: JSON.stringify({
					name: name,
					with: uuids,
				})
			})
			threads()
		})()
		return false
	})
	return dialog
}

function dialog_add() {
	let dialog = HTMLasDOM(HTML_dialog_add())
	let ui_form = dialog.querySelector("form")
	let ui_select = dialog.querySelector("select")

	document.getElementById("thread_add_dialog").addEventListener("click", () => {
		dialog.showModal()
		for (const opt of ui_select.querySelectorAll("option")) {
			opt.classList.remove("hidden")
			if (MEMBER_LIST.findIndex(u => opt.value == u.uid) != -1) {
				opt.classList.add("hidden")
			}
		}
		ui_select.value = ""
		ui_form.reset()
	})

	ui_form.addEventListener("submit", event => {
		event.preventDefault()
		dialog.close()
		let thread = THREAD
		let uid = ui_select.value;
		(async () => {
			await fetch(`/chat/${THREAD}/invite`, {
				method: "POST",
				body: JSON.stringify({
					others: [+uid]
				})
			})
			thread_load(thread)
		})()
		return false
	})

	return dialog
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

function HTML_avatar(user, size = 32) {
	return /* HTML */ `<img src="${avatar(user, size)}" width="${size}" height="${size}">`
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

function HTML_dialog_create() {
	let ui_opts_user = Array.from(USERS.map(user => /* HTML */`<option value="${user.uid}">${user.name ?? user.email ?? user.uid}</option>`)).join("\n")
	return /* HTML */ `
	<dialog>
		<div class="head">
			<h1>Create a new Chat</h1>
			<button type="button">X</button>
		</div>
		<form class="submit">
			<label for="form_create_thread_name">Chat Name</label>
			<input type="text" name="name" id="form_create_thread_name" required>
			<div class="picker">
				<select>
					<option value="">Select a User...</option>
					${ui_opts_user}
				</select>
				<button type="button">+</button>
			</div>
			<div class="selected"></div>
			<button type="submit">Create</button>
		</form>
	</dialog>`
}

function HTML_dialog_add() {
	let ui_opts_user = Array.from(USERS.map(user => /* HTML */`<option value="${user.uid}">${user.name ?? user.email ?? user.uid}</option>`)).join("\n")
	return /* HTML */ `
	<dialog>
		<div class="head">
			<h1>Create a new Chat</h1>
			<button type="button">X</button>
		</div>
		<form class="picker">
			<select required>
				<option value="">Select a User...</option>
				${ui_opts_user}
			</select>
			<button type="submit">+</button>
		</form>
	</dialog>
	`
}

instansiate_dialog();
threads();
sender();
