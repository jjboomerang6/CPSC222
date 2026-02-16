from flask import Flask, request, jsonify
import subprocess
import base64

app = Flask(__name__)

USERNAME = "test"
PASSWORD = "abcABC123"

def check_auth(auth_header):
	if not auth_header:
		return False
	try:
		encoded = auth_header.split(" ")[1]
		decoded = base64.b64decode(encoded).decode("utf-8")
		username, password = decoded.split(":")
		return username == USERNAME and password == PASSWORD
	except:
		return False


@app.route('/api/users', methods=['POST'])
def users():
	if not check_auth(request.headers.get("Authorization")):
		return jsonify({"error": "Unauthorized"}), 401

	output = subprocess.check_output(["cut", "-d:", "-f1", "/etc/passwd"])
	users = output.decode().splitlines()
	return jsonify(dict(enumerate(users)))


@app.route('/api/groups', methods=['POST'])
def groups():
	if not check_auth(request.headers.get("Authorization")):
		return jsonify({"error": "Unauthorized"}), 401
	output = subprocess.check_output(["cut", "-d:", "-f1", "/etc/group"])
	groups = output.decode().splitlines()
	return jsonify(dict(enumerate(groups)))

if __name__ == '__main__':
	app.run(host='0.0.0.0', port=3000)
