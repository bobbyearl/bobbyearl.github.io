var fieldSeperator = ',';

function GetUnity() 
{
	if (typeof unityObject != "undefined") 
	{
		return unityObject.getObjectById("unityPlayer");
	}
	return null;
}

// Item Ready
function ItemReady_Event(status, singlePage){
	WriteLog("ready event received. " + "Status: " + status + " IsSinglePage: " + singlePage);
	if (typeof autostart === 'boolean' && autostart === true) {
		InitializeSetting_Request_ENG_BLUE(100);
	}
}

// Text To Speech
function TextForTTS_Request(itemId) {
	var unity = GetUnity();
	if (unity != null) {
		WriteLog('TTS Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'TextForTTS_Request', parseInt(itemId, 10));
	}
	else {
		WriteLog('Error in function TextForTTS_Request() : Unity object is null')
	}
}

function TextForTTS_Reply(itemId, status, ttsText) {
	WriteLog('TTS Reply' + fieldSeperator + itemId + fieldSeperator + status + fieldSeperator + ttsText);
}

//Save Item State Information
function ItemStateInfo_Request(itemId) {
	var unity = GetUnity();
	if (unity != null) {
		WriteLog('State Info Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'ItemStateInfo_Request', parseInt(itemId, 10));
	}
	else {
		WriteLog('Error in function ItemStateInfo_Request() : Unity object is null')
	}
}

function ItemStateInfo_Reply(itemId, status, stateInfo) {
	document.getElementById("state").value = stateInfo;
	WriteLog('State Info Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//Change Language
function ChangeLanguage_Request(requestInfo)
{
	var requestInfoArray = requestInfo.split(',');
	var itemId = requestInfoArray[0];
	var language = requestInfoArray[1];
	var unity = GetUnity();
	if(unity != null)
	{
		WriteLog('Change Language Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'ChangeLanguage_Request', parseInt(itemId, 10) + ',' + language);
	}
	else
	{
		WriteLog('Error in function ChangeLanguage_Request() : Unity object is null')
	}	
}

function ChangeLanguage_Reply(itemId, status)
{
	WriteLog('Change Language Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//Change Skin
function ChangeSkin_Request(requestInfo)
{
	var requestInfoArray = requestInfo.split(',');
	var itemId = requestInfoArray[0];
	var theme = requestInfoArray[1];
	var unity = GetUnity();
	if(unity != null) {
		WriteLog('Change Skin Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'ChangeSkin_Request', parseInt(itemId, 10) + ',' + theme);
	}
	else
	{
		WriteLog('Error in function ChangeSkin_Request() : Unity object is null')
	}	
}

function ChangeSkin_Reply(itemId, status)
{
	WriteLog('Change Skin Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//Pause
function PauseItem_Request(itemId) {
	var unity = GetUnity();
	if (unity != null) {
		WriteLog('Pause Item Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'PauseItem_Request', parseInt(itemId, 10));
	}
	else {
		WriteLog('Error in function PauseItem_Request() : Unity object is null')
	}
}

function PauseItem_Reply(itemId, status, stateInfo) {
	document.getElementById("state").value = stateInfo;
	WriteLog('Pause Item Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//Resume
function ResumeItem_Request(itemId) {
	var stateInfo = document.getElementById('state').value;
	if (stateInfo == '') {
		alert('state info is empty');
		return;
	}
	var unity = GetUnity();
	if (unity != null) {
		WriteLog('Resume Item Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'ResumeItem_Request', parseInt(itemId, 10) + ',' + stateInfo);
	}
	else {
		WriteLog('Error in function ResumeItem_Request() : Unity object is null')
	}
}

function ResumeItem_Reply(itemId, status) {
	WriteLog('Resume Item Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//Initialize user settings
function InitializeSetting_Request_ENG_BLUE(itemId) {
	var paramObjectStringToUnity = '<stateInfo><value>{"language": "ENG", "skin": "blue", "accessionNumber":"VE11111", "itemType": "SBT", "blockCode": "H2MX94"}</value></stateInfo>';

	var unity = GetUnity();
	if (unity != null) {
		WriteLog('Init Request Sent(ENG_BLUE)' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'InitializeSetting_Request', parseInt(itemId, 10) + ',' + paramObjectStringToUnity);
	}
	else {
		WriteLog('Error in function InitializeSetting_Request() : Unity object is null')
	}
}

function InitializeSetting_Request_SPA_BLUE(itemId) {
	var paramObjectStringToUnity = '<stateInfo><value>{"language": "SPA", "skin": "blue", "accessionNumber":"VE11111", "itemType": "SBT", "blockCode": "H2MX94"}</value></stateInfo>';

	var unity = GetUnity();
	if (unity != null) {
		WriteLog('Init Request Sent(SPA_BLUE)' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'InitializeSetting_Request', parseInt(itemId, 10) + ',' + paramObjectStringToUnity);
	}
	else {
		WriteLog('Error in function InitializeSetting_Request() : Unity object is null')
	}
}

function InitializeSetting_Reply(itemId, status) {
	WriteLog('Init Setting Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//Highlight
function HighlightText_Request(itemId)
{
	var unity = GetUnity();
	if(unity != null) {
		WriteLog('Highlight Request Sent' + fieldSeperator + itemId);
		unity.SendMessage("UnityObject", 'HighlightText_Request', parseInt(itemId, 10));
	}
	else
	{
		WriteLog('Error in function HighlightText_Request() : Unity object is null')
	}
}

function HighlightText_Reply(itemId, status) {
	WriteLog('Highlight Text Reply' + fieldSeperator + itemId + fieldSeperator + status);
}

//End of item reached
function EndOfItemReached_Event() {
	alert('End of item reached');
}

function ActiveScene_Event(sceneId) {
	WriteLog('Active Scene Event Recieved' + fieldSeperator + sceneId);
}
//HandleError
function HandleError(str) {
	WriteError("HandleError :" + str);
}

var logItemNumber=0;
function WriteLog(str) {
	logItemNumber++;
	var logDiv = document.getElementById("log");
	logDiv.innerHTML = logDiv.innerHTML + "<br>" + logItemNumber + " - " + str;
}
function WriteError(str) {
	logItemNumber++;
	var errorDiv = document.getElementById("error");
	errorDiv.innerHTML = errorDiv.innerHTML + "<br>" + logItemNumber + " - " + str;
}
