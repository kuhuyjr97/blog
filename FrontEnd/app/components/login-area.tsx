"use client";

import { ChangeEvent, useState, useEffect } from "react";
import { ToastContainer, toast } from "react-toastify";
import Cookies from "js-cookie";
import "react-toastify/dist/ReactToastify.css";

import FormInput from "@/app/components/form-input";
import Button from "@/app/components/button";
import { login } from "@/app/api/authenticate";

const FormLogin = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  useEffect(() => {
    const accessToken = Cookies.get("accessToken");
    if (accessToken !== undefined) {
      window.location.assign("/attendance/create");
    }
  }, []);

  const handleUsernameChange = (event: ChangeEvent<HTMLInputElement>) => {
    setEmail(event.target.value);
  };

  const handlePasswordChange = (event: ChangeEvent<HTMLInputElement>) => {
    setPassword(event.target.value);
  };

  const validateLoginForm = () => {
    // Regular expression for email format validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Regular expression for password format validation
    const passwordRegex =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!email || !password) {
      toast.error("Email and password are required.");
      return false;
    }

    if (!emailRegex.test(email)) {
      toast.error("Invalid email format.");
      return false;
    }

    if (!passwordRegex.test(password)) {
      toast.error(
        "Password must be at least 8 characters long and contain both letters and numbers and special characters."
      );
      return false;
    }

    return true;
  };

  const Login = async () => {
    // if (!validateLoginForm()) {
    //   return;
    // }
    try {
      const response = await login(email, password);
      Cookies.set("accessToken", response.data.token);
      Cookies.set("user", response.data?.user?.full_name);
      window.location.assign("/attendance/create");
    } catch (error: any) {
      if (error?.status === 404) {
        toast.error(error.data);
      }
      for (let key in error?.data?.message) {
        toast.error(`${key}: ${error?.data?.message[key]}`);
      }
    }
  };

  const handleKeyDown = (event: React.KeyboardEvent<HTMLInputElement>) => {
    if (event.key === "Enter") {
      Login();
    }
  };

  return (
    <div className="flex items-center justify-center">
      <div>
        <FormInput
          label="Email:"
          type="email"
          value={email}
          onChange={handleUsernameChange}
        />
        <FormInput
          label="Password:"
          type="password"
          value={password}
          onChange={handlePasswordChange}
          onKeyDown={handleKeyDown}
        />
        <div className="flex items-center pt-6">
          <input
            type="checkbox"
            className="w-4 h-4 border border-black"
            id="checkbox"
          />
          <label htmlFor="checkbox" className="pl-4">
            Remember password
          </label>
        </div>
        <div className="flex items-center pt-6">
          <label
            htmlFor="forgot-password"
            className="hover:text-blue-600 cursor-pointer"
          >
            Forgot password
          </label>
          <div className="pl-28">
            <Button label="Login" onClick={Login} />
          </div>
        </div>
      </div>
      <ToastContainer position="top-center" />
    </div>
  );
};

export default FormLogin;
