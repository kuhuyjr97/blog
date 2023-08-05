// ParentComponent.tsx

"use client";

import { useState } from "react";
import Footer from "../layouts/footer";
import Header from "../layouts/header";
import Sidebar from "../layouts/sidebar";

export default function PagesLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  const [isSidebarOpen, setSidebarOpen] = useState(false);
  const [hasAccessToken, setHasAccessToken] = useState<string>("");
  console.log(isSidebarOpen);
  return (
    <>
      <Header
        isOpen={isSidebarOpen}
        setIsOpen={setSidebarOpen}
        hasAccessToken={hasAccessToken}
        setHasAccessToken={setHasAccessToken}
      />
      <main className="mx-auto w-full" style={{ height: "85vh" }}>
        {hasAccessToken ? <></> : <div className="col-span-12">{children}</div>}

        {hasAccessToken && (
          <div className="lg:grid lg:grid-cols-12">
            <div className="col-span-2">
              <Sidebar
                isOpen={isSidebarOpen}
                hasAccessToken={hasAccessToken}
                onClose={() => setSidebarOpen(!isSidebarOpen)}
                onLinkClick={() => setSidebarOpen(false)}
              />
            </div>
            <div className="col-span-10">{children}</div>
          </div>
        )}
      </main>
      <Footer />
    </>
  );
}
