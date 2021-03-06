import React from "react";
import { CardElement } from "@stripe/react-stripe-js";
import { Card, Col, Row } from "antd";
import { useTranslation } from "react-i18next";

interface CardSectionProps {}

const CARD_ELEMENT_OPTIONS = {
  style: {
    base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4",
      },
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a",
    },
  },
};

const CardSection = () => {
  const { t } = useTranslation("client");
  return (
    <Row>
      <Col span={12}>
        <label>
          {t("cardDetails")}
          <Card>
            <CardElement options={CARD_ELEMENT_OPTIONS} />
          </Card>
        </label>
      </Col>
    </Row>
  );
};

export default CardSection;
