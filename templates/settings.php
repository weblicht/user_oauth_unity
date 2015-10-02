<form id="user_oauth_unity" action="#" method='post'>
    <div class="section">
        <h2>OAuth</h2>
        <span class="msg"><?php p($l->t('Provide the OAuth 2.0 Authorization Server OAuth2 endpoint here. '));?></span>
        <br/>
        <label for="tokenIntrospectionEndpoint ">OAuth2 endpoint:</label><input type="text" size="100" name="tokenIntrospectionEndpoint" id="tokenIntrospectionEndpoint" value="<?php p($_['tokenIntrospectionPoint']); ?>" title="<?php p($l->t('Introspection endpoint'));?>" />
        <br/>
        <input type="submit" value="Save" />
    </div>
</form>
