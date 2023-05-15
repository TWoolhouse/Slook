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

function bind_route(route) {
	let ui_route = HTMLasDOM(HTML_route(route ?? ""))
	let ui_text = ui_route.querySelector(".url")
	let ui_embed = ui_route.querySelector(".res")

	let cb = async event => {
		let res = await (await fetch(ui_text.value)).json()
		ui_embed.innerHTML = JSON.stringify(res, null, 2)
	}
	ui_route.querySelector("form").addEventListener("submit", event => {
		event.preventDefault()
		cb()
		return false
	})
	cb()
	return ui_route
}

function bind_graph(route) {
	let ui_route = HTMLasDOM(HTML_graphing(route ?? ""))
	let ui_text = ui_route.querySelector(".url")
	let ui_img = ui_route.querySelector(".res")

	let cb = async event => {
		let res = await (await fetch(ui_text.value)).json()
		console.log(res);
		ui_img.src = res["graph"] ?? res[res["plot"]]["graph"]
	}
	ui_route.querySelector("form").addEventListener("submit", event => {
		event.preventDefault()
		cb()
		return false
	})
	cb()
	return ui_route
}

function HTML_graphing(route) {
	return /* HTML */ `
	<section>
		<form>
			<input type="text" class="url" value="${route}">
		</form>
		<img class="res" src="">
	</section>`}

function HTML_route(route) {
	return /* HTML */ `
	<section>
		<form>
			<input type="text" class="url" value="${route}">
		</form>
		<pre class="res"></pre>
	</section>`
}

const TR = 0
const TG = 1

ROUTES = [
	[TG, "/data/3/tasks?img"],
	[TR, "/data/3/tasks?imgr"],
	[TR, "/data/3/tasks"],
	[TR, "/data/1/leading?projects"],
	[TR, "/data/1/eta?users"],
	[TR, "/data/1/count/tasks?projects&tasks"],
	[TG, "/data/2/count/hours?projects&img"],
	[TR, "/data/2/count/hours?projects&imgr"],
]

let ui_main = document.querySelector("main")
const STEP = 100;
let wait = -STEP;
for (const route of ROUTES) {
	switch (route[0]) {
		case TR: setTimeout(() => ui_main.appendChild(bind_route(route[1])), (() => { wait += STEP; return wait })()); break;
		case TG: setTimeout(() => ui_main.appendChild(bind_graph(route[1])), (() => { wait += STEP; return wait })()); break;
	}
}
