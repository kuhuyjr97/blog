"use client";
import React, { useState, useEffect } from "react";
import Button from "@/app/components/button";
import { useRouter } from "next/navigation";
import Cookies from "js-cookie";
import { startWork, endWork } from "@/app/api/attendanceApi";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import FilterArea from "@/app/components/filter-area";
const Attendance = () => {
  return (
    <div>
      <main className="mx-auto  ">
        <div className=" flex flex-col items-center px-6 py-24 lg:px-24 lg:py-28  ">
          <h2 className="w-full text-2xl">/ Attendance </h2>
          <div className="w-3/5">
            <FilterArea />
          </div>
        </div>
      </main>
    </div>
  );
};

export default Attendance;
