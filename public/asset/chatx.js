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

function HTML_route(route) {
	return /* HTML */ `
	<section>
		<form>
			<input type="text" class="url" value="${route}">
		</form>
		<pre class="res"></pre>
	</section>`
}

ROUTES = [
	"/chat",
	"/chat/1",
	"/chat/1/message?limit=5",
	"/chat/1/message?limit=5&cursor=10",
	"/chat/1/message?limit=5&cursor=10&fwd",
]

let ui_main = document.querySelector("main")
for (const route of ROUTES) {
	ui_main.appendChild(bind_route(route))
}
