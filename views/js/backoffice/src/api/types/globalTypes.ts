/* tslint:disable */
/* eslint-disable */
// @generated
// This file was automatically generated and should not be edited.

//==============================================================
// START Enums and Input Objects
//==============================================================

/**
 * An enumeration.
 */
export enum AccountAccountStatus {
  BANNED = "BANNED",
  PAID_ACCOUNT = "PAID_ACCOUNT",
  REGISTERED = "REGISTERED",
  WAITING_PAYMENT = "WAITING_PAYMENT",
}

/**
 * An enumeration.
 */
export enum BuildBuildStatus {
  GENERATING = "GENERATING",
  PUBLISHED = "PUBLISHED",
  QUEUED = "QUEUED",
  STALLED = "STALLED",
  UPLOADING = "UPLOADING",
  WAITING = "WAITING",
}

/**
 * An enumeration.
 */
export enum PlanInterval {
  DAY = "DAY",
  MONTH = "MONTH",
  WEEK = "WEEK",
  YEAR = "YEAR",
}

export interface PaymentMethodAppInput {
  stripeTestPublic: string;
  stripeTestSecret: string;
  stripeProdPublic: string;
  stripeProdSecret: string;
}

export interface StoreAppColorInput {
  color?: string | null;
  text?: string | null;
}

export interface StoreAppInput {
  name: string;
  color?: StoreAppColorInput | null;
  links?: StoreAppLinksInput | null;
  apiLink?: string | null;
  template?: string | null;
  logo?: any | null;
}

export interface StoreAppLinksInput {
  androidLink?: string | null;
  iosLink?: string | null;
}

//==============================================================
// END Enums and Input Objects
//==============================================================
