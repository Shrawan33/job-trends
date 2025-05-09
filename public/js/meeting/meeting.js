window.addEventListener('DOMContentLoaded', function(event) {
    console.log('DOM fully loaded and parsed');
    websdkready();
  });

  function websdkready() {
    // tool.js
    var testTool = window.testTool;
    // get meeting args from url
    var tmpArgs = testTool.parseQuery();
    var meetingConfig = {
      apiKey: tmpArgs.apiKey,
      meetingNumber: tmpArgs.mn,
      userName: (function () {
        if (tmpArgs.name) {
          try {
            return testTool.b64DecodeUnicode(tmpArgs.name);
          } catch (e) {
            return tmpArgs.name;
          }
        }
        return (
         ''
        );
      })(),
      passWord: tmpArgs.pwd,
    leaveUrl: 'http://www.zoom.us',
      role: parseInt(tmpArgs.role, 10),
      userEmail: (function () {
        try {
          return testTool.b64DecodeUnicode(tmpArgs.email);
        } catch (e) {
          return tmpArgs.email;
        }
      })(),
      lang: tmpArgs.lang,
      signature: tmpArgs.signature || "",
      china: tmpArgs.china === "1",
    };

    // a tool use debug mobile device
    if (testTool.isMobileDevice()) {
      // vconsole.min.js
      vConsole = new VConsole();
    }
    console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

    // it's option if you want to change the WebSDK dependency link resources. setZoomJSLib must be run at first
    // ZoomMtg.setZoomJSLib("https://source.zoom.us/1.9.0/lib", "/av"); // CDN version defaul
    if (meetingConfig.china)
      ZoomMtg.setZoomJSLib("https://jssdk.zoomus.cn/1.9.0/lib", "/av"); // china cdn option
    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();
    function beginJoin(signature) {
      ZoomMtg.init({
        leaveUrl: meetingConfig.leaveUrl,
        webEndpoint: meetingConfig.webEndpoint,
        success: function () {
          console.log(meetingConfig);
          console.log("signature", signature);
          ZoomMtg.i18n.load(meetingConfig.lang);
          ZoomMtg.i18n.reload(meetingConfig.lang);
          ZoomMtg.join({
            meetingNumber: meetingConfig.meetingNumber,
            userName: meetingConfig.userName,
            signature: signature,
            apiKey: meetingConfig.apiKey,
            userEmail: meetingConfig.userEmail,
            passWord: meetingConfig.passWord,
            success: function (res) {
              console.log("join meeting success");
              console.log("get attendeelist");
              ZoomMtg.getAttendeeslist({});
              ZoomMtg.getCurrentUser({
                success: function (res) {
                  console.log("success getCurrentUser", res.result.currentUser);
                },
              });
            },
            error: function (res) {
              console.log(res);
            },
          });
        },
        error: function (res) {
          console.log(res);
        },
      });
    }

    beginJoin(meetingConfig.signature);
  };
