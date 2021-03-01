import requests

url = "http://localhost/Automated_Security_System/testingapi.php"

payload="{\"id\":\"1\",\r\n\"name\":\"nitesh\",\r\n\"temp\":\"97\"\r\n}"
headers = {
  'Content-Type': 'application/json'
}

response = requests.request("POST", url, headers=headers, data=payload)
print(response)

print(response.text)
