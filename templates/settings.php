<form id="user_oauth_unity" action="#" method='post'>
    <div class="section">
        <h2>OAuth</h2>
        <span class="msg"><?php p($l->t('Provide the OAuth 2.0 Authorization Server tokeninfo endpoint here. If authentication is required, specify the user name and password as well.'));?></span>
        <br/>
        <label for="tokeninfoEndpoint ">Tokeninfo point:</label><input type="text" size="100" name="tokeninfoEndpoint" id="tokeninfoEndpoint" value="<?php p($_['tokeninfoEndpoint']); ?>" title="<?php p($l->t('Introspection endpoint'));?>" />
        <br/>
        <label for="userinfoEndpoint ">Userinfo point:</label><input type="text" size="100" name="userinfoEndpoint" id="userinfoEndpoint" value="<?php p($_['userinfoEndpoint']); ?>" title="<?php p($l->t('Introspection endpoint'));?>" />
        <br/>
        <input type="submit" value="Save" />
    </div>
</form>
