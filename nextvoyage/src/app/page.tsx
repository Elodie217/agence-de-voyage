"use client";

import { IoIosArrowDropdown } from "react-icons/io";
import { Bouton } from "./Components/Bouton";
import { Nav } from "./Components/Nav";
import Footer from "./Components/Footer";
import { useEffect, useState } from "react";
import { getAllVoyages, getLastVoyages } from "./Services/voyages";
import { useRouter } from "next/navigation";
import { Bars } from "react-loader-spinner";

export default function Home() {
  const { push } = useRouter();

  push("/accueil");

  return <main className=" text-lg"></main>;
}
