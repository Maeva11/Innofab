<div class="footer" style="width: 100%; max-width: 1728px; height: 281px; padding-top: 21px; padding-bottom: 46px; padding-left: 20px; padding-right: 20px; background: white; justify-content: center; align-items: center; display: flex; box-sizing: border-box;">
    <div style="height: 214px; padding-left: 15px; padding-right: 15px; opacity: 0.96; justify-content: space-between; align-items: flex-start; display: flex;">
        <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; display: inline-flex">
            <div style="width: 471px; height: 148px; position: relative">
                <div style="width: 456px; height: 21px; left: 0px; top: 0px; position: absolute"><span
                            style="color: #EA581C; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 21px; word-wrap: break-word">Innofab</span><span class="infos"
                            style="color: #313030; font-size: 14px; font-family: Roboto; font-weight: 400; line-height: 21px; word-wrap: break-word"> est financé par l’Union Européenne dans le cadre du fond Feder</span>
                </div>
                <img style="width: 86.66px; height: 67.58px; left: 0px; top: 36px; position: absolute"
                     src="/themes/assets/images/UE.jpg"/>
                <img style="width: 86.66px; height: 86.66px; left: 122px; top: 36px; position: absolute"
                     src="/themes/assets/images/RO.png"/>
                <img style="width: 86.66px; height: 60.66px; left: 244px; top: 36px; position: absolute"
                     src="/themes/assets/images/SC.png"/>
                <img style="width: 86.66px; height: 52.64px; left: 366px; top: 36px; position: absolute"
                     src="/themes/assets/images/engage.jpg"/>
            </div>
            <div style="width: 471px; height: 66px; position: relative">
                <div class="infos" style="height: 18px; font-size:13px; padding-bottom: 1.49px; padding-right: 2.99px; left: 0px; top: 62%; position: absolute; justify-content: center; align-items: center; display: inline-flex">
                   <i class="fa-regular fa-clock"></i>
                </div>
                <div class="infos" style="width: 305.91px; height: 16px; left: 24px; top: 38px; position: absolute; color: #313030; font-size: 14px; font-family: Roboto; font-weight: 400; line-height: 21px; word-wrap: break-word">
                    <?= Tools::getValue('Horaires'); ?>
                </div>
                <div style="width: 318.66px; height: 37px; left: 0px; top: 0px; position: absolute; color: #EA581C; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 21px; word-wrap: break-word">
                    Horaires d'ouverture
                </div>
            </div>
        </div>
        <div style="width: 300px; position: relative">
            <div style="width: 148px; height: 21px; left: 0px; top: 0px; position: absolute; color: #EA581C; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 21px; word-wrap: break-word">
                Membres fondateurs
            </div>
            <img class="membres-partner" src="/themes/assets/images/membres.png"/>
        </div>
        <div style="flex-direction: column; justify-content: flex-start; align-items: flex-end; gap: 60px; display: inline-flex">
            <div style="flex-direction: column; justify-content: flex-start; align-items: flex-start; gap: 10px; display: flex">
                <div class="infos" style="width: 132.07px; height: 21px; color: #EA581C; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 21px; word-wrap: break-word">
                    Contact
                </div>
                <div style="justify-content: flex-start; align-items: flex-end; gap: 10px; display: inline-flex">
                    <div class="infos" style="width: 15px; height: 14.63px; font-size: 12px">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="infos" style="width: 100.14px; height: 16px; color: #1F2243; font-size: 14px; font-family: Roboto; font-weight: 400; line-height: 21px; word-wrap: break-word">
                        <?= Tools::getValue('Téléphone'); ?>
                    </div>
                </div>
                <div style="justify-content: flex-start; align-items: center; gap: 10px; display: inline-flex">
                    <div class="infos" style="width: 15px; height: 14.63px; font-size: 12px">
                        <i class="fas fa-at"></i>
                    </div>
                    <div class="infos" style="width: 207px; height: 16px; color: #1D2140; font-size: 14px; font-family: Roboto; font-weight: 400; line-height: 21px; word-wrap: break-word">
                        <?= Tools::getValue('E-mail'); ?>
                    </div>
                </div>
                <a href="/mentions-legales" style="color: #EA581C; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 21px; text-decoration: none;">Mentions Légales</a>
            </div>
            <div style="width: 232px; height: 67px; position: relative">
                <div class="infos" style="width: 228.45px; height: 21px; left: 3.55px; top: 0px; position: absolute; color: #EA581C; font-size: 14px; font-family: Roboto; font-weight: 700; line-height: 21px; word-wrap: break-word">
                    Réseaux Sociaux
                </div>
                <div style="width: 169px; height: 36px; padding-left: 1px; padding-right: 4.22px; left: 0px; top: 31px; position: absolute; justify-content: center; align-items: flex-start; gap: 7px; display: inline-flex">
                    <div style="width: 36px; align-self: stretch; padding-left: 11.78px; padding-right: 11.78px; padding-top: 6px; padding-bottom: 6px; background: #EA581C; border-radius: 18px; justify-content: center; align-items: center; display: inline-flex">
                        <a href=" <?= Tools::getValue('Discord'); ?>" target="_blank"><i class="fa-brands fa-discord" style="font-size: 20px; color: white;"></i></a>
                    </div>
                    <div style="width: 36px; align-self: stretch; padding-top: 6px; padding-bottom: 6px; padding-left: 7.89px; padding-right: 7.13px; background: #EA581C; border-radius: 18px; justify-content: center; align-items: center; display: inline-flex">
                        <a href=" <?= Tools::getValue('Facebook'); ?>" target="_blank"><i class="fa-brands fa-facebook-f" style="font-size: 20px; color: white;"></i></a>
                    </div>
                    <div style="width: 36px; align-self: stretch; padding: 6px; background: #EA581C; border-radius: 18px; justify-content: center; align-items: center; display: inline-flex">
                        <a href=" <?= Tools::getValue('Youtube'); ?>" target="_blank"><i class="fa-brands fa-youtube" style="font-size: 20px; color: white;"></i></a>
                    </div>
                    <div style="width: 36px; align-self: stretch; padding-top: 4px; padding-bottom: 4px; padding-left: 4.22px; padding-right: 3.78px; background: #EA581C; border-radius: 18px; justify-content: center; align-items: center; display: inline-flex">
                        <div style="flex: 1 1 0; justify-content: center; align-items: center; display: inline-flex">
                            <div style="width: 36px; align-self: stretch; padding: 6px; background: #EA581C; border-radius: 18px; justify-content: center; align-items: center; display: inline-flex">
                                <a href=" <?= Tools::getValue('instagram'); ?>" target="_blank"><i class="fa-brands fa-instagram" style="font-size: 20px; color: white;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  