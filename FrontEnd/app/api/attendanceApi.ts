import axios from "@/app/api/axiosInstance";

const BASE_URL = process.env.BASE_URL;

interface LogResponse {
  data: any;
  body: any;
  status: number;
}

export const startWork = async (datetime: string): Promise<LogResponse> => {
  const response = await axios.post<LogResponse>(
    `${BASE_URL}/attendance/checkin`,
    {
      datetime,
    }
  );
  return response.data;
};
export const endWork = async (datetime: string): Promise<LogResponse> => {
  const response = await axios.post<LogResponse>(
    `${BASE_URL}/attendance/checkout`,
    {
      datetime,
    }
  );
  return response.data;
};
