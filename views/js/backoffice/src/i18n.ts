import i18n from "i18next";
import { initReactI18next } from "react-i18next";
import Backend from "i18next-http-backend";

i18n
  .use(Backend)
  .use(initReactI18next)
  .init({
    fallbackLng: "es",
    debug: true,
    backend: {
      loadPath: "/locales/{{lng}}/{{ns}}.json",
    },
    ns: ["translation", "admin", "auth", "client"],
  });

export default i18n;