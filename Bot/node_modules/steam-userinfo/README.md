# Steam User Info for Node.js
Tiny node.js module to fetch steam user data from steamID64s

This was created so that persona names could be found from steamIDs given in trade offers

# Installation

```
npm install steam-userinfo
```

# Usage

Require the module and run the setup method with your Steam Web API key (string)

```js
var steamuserinfo = require('steam-userinfo');

steamuserinfo.setup(yourapikey);
```
# Methods

## setup(apikey)

Must be used to provide the module with a valid api key before any other methods

## getUserInfo(steamID64, callback)

Returns a javascript object of data on the steamID64 in question. Can also take an array of steamID64s (strings) in place of a single string and will return the data for every player. 

Callback as an error-first function(error, data){}

```js
steamuserinfo.getUserInfo(steamID64, function(error, data){
	if(error) throw error;
	//process the data
	console.log(JSON.stringify(data.response));
});
```

# Contributions

Feel free to contribute in any way you want - this was created as a quick fix and thought I would share.

Open an issue if any bugs are found.