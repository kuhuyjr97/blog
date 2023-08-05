"use client";
import React, { useState, useEffect } from "react";
import Button from "@/app/components/button";
import { useRouter } from "next/navigation";
import Cookies from "js-cookie";
import { startWork, endWork } from "@/app/api/attendanceApi";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Attendance = () => {
  const router = useRouter();
  const accessToken = Cookies.get("accessToken");
  if (!accessToken || accessToken === "undefined") {
    router.push("/login");
  }

  const [currentTime, setCurrentTime] = useState<string>();
  function getModifiedTime() {
    const date = new Date();
    date.setDate(date.getDate() + 0);
    date.setHours(date.getHours() + 7);
    return date.toISOString().slice(0, 19).replace("T", " ");
  }
  useEffect(() => {
    setCurrentTime("---------- --:--:--");
    const interval = setInterval(() => {
      setCurrentTime(getModifiedTime());
    }, 1000);
    return () => {
      clearInterval(interval);
    };
  }, []);

  const displayError = (error: any) => {
    if (error?.status === 404) {
      toast.error(error.data);
    }
    for (let key in error?.data?.message) {
      toast.error(`${key}: ${error?.data?.message[key]}`);
    }
  };

  const [successMessage, setSuccessMessage] = useState<string>("");
  const handleStartWork = async () => {
    try {
      const currentTime = getModifiedTime();
      await startWork(currentTime);
      const message = `You've just started work at ${currentTime} `;
      setSuccessMessage(message);
      toast.success(message);
    } catch (error: any) {
      displayError(error);
    }
  };
  const handleEndWork = async () => {
    try {
      const currentTime = getModifiedTime();
      await endWork(currentTime);
      const message = `You've just ended work at ${currentTime} `;
      setSuccessMessage(message);
      toast.success(message);
    } catch (error: any) {
      displayError(error);
    }
  };
  return (
    <div>
      <main className="mx-auto  ">
        <div className=" flex flex-col items-center px-6 py-24 lg:px-24 lg:py-28  ">
          <h2 className="w-full text-2xl">/ Attendance </h2>
          <div className=" py-24 pb-16">
            <p className="text-center text-3xl font-bold">{currentTime}</p>
          </div>
          <div className="flex flex-col lg:flex-row">
            <div className="p-4 lg:p-12">
              <Button label="Start work" onClick={handleStartWork} />
            </div>
            <div className="p-4 lg:p-12">
              <Button label="End work" onClick={handleEndWork} />
            </div>
          </div>

          <p className="text-center text-lg pt-20">{successMessage}</p>
        </div>
      </main>
      <ToastContainer position="top-center" />
    </div>
  );
};

export default Attendance;
