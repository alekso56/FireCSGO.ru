var request = require('request');
var cheerio = require('cheerio');
var apikey = '';

var getUserInfo = function (steamids, callback){
	var sid = "";

	if(steamids.constructor === Array){
		if(steamids.length > 99) return callback(new Error('Cannot request more than 99 steamids'));
		steamids.forEach(function(id){
			sid += id + ',';
		});
		sid = sid.slice(0,-1);
	} else {
		sid += steamids;
	}
	var url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='+apikey+'&steamids='+ sid + '&format=json';
	request({
		url: url,
		json: true
	}, function(error, response, body){
		if(!error && response.statusCode === 200){
			callback(null, body);
		} else if (error){
			callback(error);
		}
	});
}

var setup = function(key){
	apikey = key;
}

module.exports = {
	getUserInfo: getUserInfo,
	setup: setup
}