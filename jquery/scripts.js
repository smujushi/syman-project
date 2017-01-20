function checkRoundStatus(player){
	var status = false;
	$.ajax({
		url: "server.php?status=1",
		type: "POST",
		data: {
			player: player[id],
		},
		success: function(results){
			status = results;
		}
	});
	return status;
}

function secondsToString(seconds){
	var numyears = Math.floor(seconds / 31536000);
	var numdays = Math.floor((seconds % 31536000) / 86400);
	var numhours = Math.floor(((seconds % 31536000) % 86400) / 3600);
	var numminutes = Math.floor((((seconds % 31536000) % 86400) % 3600) / 60);
	var numseconds = Math.round((((seconds % 31536000) % 86400) % 3600) % 60);
	var formatted = "";
	if(numyears){
		formatted += numyears + (numyears === 1 ? " year " : " years ");
	}
	if(numdays){
		formatted += numdays + (numdays === 1 ? " day " : " days ");
	}
	if(numhours){
		formatted += numhours + (numhours === 1 ? " hour " : " hours ");
	}
	if(numminutes){
		formatted += numminutes + (numminutes === 1 ? " minute " : " minutes ");
	}
	if(numseconds){
		formatted += numseconds + (numseconds === 1 ? " second " : " seconds ");
	}
	return formatted;
}

function humanFileSize(bytes, si) {
	var thresh = si ? 1000 : 1024;
	if(Math.abs(bytes) < thresh) {
		return bytes + ' B';
	}
	var units = si
	? ['kB','MB','GB','TB','PB','EB','ZB','YB']
	: ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
	var u = -1;
	do {
		bytes /= thresh;
		++u;
	} while(Math.abs(bytes) >= thresh && u < units.length - 1);
	return bytes.toFixed(1)+' '+units[u];
}

function showTime(d){
	// Input Difference in Milliseconds
	// Return Minutes & Seconds (0:00)
	var msec = d, mm, ss, f;
	mm = Math.floor(msec / 1000 / 60);
	msec -= mm * 1000 * 60;
	ss = Math.floor(msec / 1000);
	f = mm + ":" + (ss < 10 ? "0"+ss : ss);
	return f;
}


$(function(){
	$("#play-btn").button();
	$("#save-player-btn").button({
		icon: { icon : 'ui-icon-check' },
		showLabel: false
	});
});
